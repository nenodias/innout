<?php
session_start();
requiredValidSession();

print_r(WorkingHours::getWorkedTimeInMonth("2020-11"));