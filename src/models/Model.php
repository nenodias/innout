<?php

class Model
{
    protected static $tableName = "";
    protected static $columns = [];

    protected $values = [];

    function __construct($arr = [], $sanitize = true)
    {
        $this->loadFromArray($arr, $sanitize);
    }

    public function loadFromArray($arr, $sanitize = true)
    {
        if ($arr) {
            $conn = Database::getConnection();
            foreach ($arr as $key => $value) {
                $cleanValue = $value;
                if ($cleanValue && $sanitize) {
                    $cleanValue = strip_tags(trim($cleanValue));
                    $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
                    $cleanValue = mysqli_real_escape_string($conn, $cleanValue);
                }
                $this->$key = $cleanValue;
            }
            $conn->close();
        }
    }

    public function __get($key)
    {
        return isset($this->values) && isset($this->values[$key]) ? $this->values[$key] : NULL;
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function getValues()
    {
        return $this->values;
    }

    public static function get($filters = [], $columns = "*")
    {
        $objects = [];
        $result = static::getResultSetFromSelect($filters, $columns);
        if ($result) {
            $class = get_called_class();
            while ($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getOne($filters = [], $columns = "*")
    {
        $result = static::getResultSetFromSelect($filters, $columns);
        $class = get_called_class();
        return $result ? new $class($result->fetch_assoc()) : null;
    }

    public static function getResultSetFromSelect($filters = [], $columns = "*")
    {
        $sql = "SELECT ${columns} FROM "
            . static::$tableName
            . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if ($result->num_rows === 0) {
            return null;
        } else {
            return $result;
        }
    }

    public function insert()
    {
        $sql = "INSERT INTO " . static::$tableName . " ("
            . implode(",", static::$columns) . " ) VALUES (";
        foreach (static::$columns as $col) {
            $sql .= static::getFormattedValue($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ")";
        $id = Database::executeSQL($sql);
        $this->id = $id;
    }

    public function update()
    {
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach (static::$columns as $col) {
            if ($col != "id") {
                $sql .= "{$col} = " . static::getFormattedValue($this->$col) . ",";
            }
        }
        $sql[strlen($sql) - 1] = " ";
        $sql .= "WHERE id = {$this->id}";
        $id = Database::executeSQL($sql);
    }

    public static function getCount($filters = [])
    {
        $result = static::getResultSetFromSelect($filters, "count(*) AS count ");
        return $result->fetch_assoc()["count"];
    }

    public function delete()
    {
        static::deleteById($this->id);
    }

    public static function deleteById($id)
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = {$id}";
        Database::executeSQL($sql);
    }

    private static function getFilters($filters)
    {
        $sql = "";
        if (count($filters) > 0) {
            $sql .= " WHERE 1 = 1 ";
            foreach ($filters as $column => $value) {
                if ($column === "raw") {
                    $sql .= " AND ${value}";
                } else {
                    $sql .= " AND ${column} = " . static::getFormattedValue($value);
                }
            }
        }
        return $sql;
    }

    private static function getFormattedValue($value)
    {
        if (is_null($value)) {
            return "null";
        } else if (gettype($value) == "string") {
            return "'${value}'";
        } else {
            return $value;
        }
    }
}
