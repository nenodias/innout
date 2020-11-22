<?php

class WorkingHours extends Model
{
    protected static $tableName = "working_hours";
    protected static $columns = [
        "id",
        "user_id",
        "work_date",
        "time1",
        "time2",
        "time3",
        "time4",
        "worked_time",
    ];

    public static function loadFromUserAndDate($userId, $workDate)
    {
        $registry = self::getOne(["user_id" => $userId, "work_date" => $workDate]);
        if (!$registry) {
            $registry = new WorkingHours([
                "user_id" => $userId,
                "work_date" => $workDate,
                "worked_time" => 0,
            ]);
        }
        return $registry;
    }

    public function getNextTime()
    {
        if (!$this->time1) {
            return "time1";
        }
        if (!$this->time2) {
            return "time2";
        }
        if (!$this->time3) {
            return "time3";
        }
        if (!$this->time4) {
            return "time4";
        }
    }

    public function getActiveClock()
    {
        $nextTime = $this->getNextTime();
        if ($nextTime === "time1" || $nextTime === "time3") {
            return "exitTime";
        } else if ($nextTime === "time2" || $nextTime === "time4") {
            return "workedInterval";
        }
        return null;
    }

    public function innout($time)
    {
        $timeColumn = $this->getNextTime();
        if (!$timeColumn) {
            throw new AppException("Você já fez os quatro apontamentos do dia.");
        }

        $this->$timeColumn = $time;
        $this->worked_time = getSecondsFromDateInterval($this->getWorkedInterval());
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function getLunchInterval()
    {
        [, $t2, $t3,] = $this->getTimes();
        $lunchInterval = new DateInterval("PT0S");
        if ($t2) {
            $lunchInterval = $t2->diff(new DateTime());
        }
        if ($t2 && $t3) {
            $lunchInterval = $t2->diff($t3);
        }
        return $lunchInterval;
    }

    public function getWorkedInterval()
    {
        [$t1, $t2, $t3, $t4] = $this->getTimes();

        $part1 = new DateInterval("PT0S");
        $part2 = new DateInterval("PT0S");

        if ($t1) {
            $part1 = $t1->diff(new DateTime());
        }
        if ($t1 && $t2) {
            $part1 = $t1->diff($t2);
        }

        if ($t3) {
            $part2 = $t3->diff(new DateTime());
        }
        if ($t3 && $t4) {
            $part2 = $t3->diff($t4);
        }
        return sumIternvals($part1, $part2);
    }

    public function getExitTime()
    {
        [$t1,,, $t4] = $this->getTimes();
        $workday = DateInterval::createFromDateString("8 hours");

        if (!$t1) {
            return (new DateTimeImmutable())->add($workday);
        } else if ($t4) {
            return $t4;
        } else {
            $total = sumIternvals($workday, $this->getLunchInterval());
            return $t1->add($total);
        }
    }

    public function getBalance()
    {
        if (!$this->time1 && !isPastWorkday($this->work_date)) {
            return "";
        }
        if ($this->worked_time == DAILY_TIME) {
            return "-";
        }
        $balance = $this->worked_time - DAILY_TIME;
        $balanceString = getTimeStringFromSeconds(abs($balance));
        $sign = $balance >= 0 ? "+" : "-";
        return "{$sign}{$balanceString}";
    }

    public static function getMonthlyReport($userId,  $date)
    {
        $registries = [];
        $startDate = getFirstDayOfMonth($date)->format('Y-m-d');
        $endDate = getLastDayOfMonth($date)->format('Y-m-d');

        $result = static::getResultSetFromSelect([
            "user_id" => $userId,
            "raw" => "work_date between '{$startDate}' AND '{$endDate}' "
        ]);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $registries[$row["work_date"]] = new WorkingHours($row);
            }
        }
        return $registries;
    }

    private function getTimes()
    {
        $times = [];

        array_push($times, $this->time1 ? getDateFromString($this->time1) : null);
        array_push($times, $this->time2 ? getDateFromString($this->time2) : null);
        array_push($times, $this->time3 ? getDateFromString($this->time3) : null);
        array_push($times, $this->time4 ? getDateFromString($this->time4) : null);

        return $times;
    }
}
