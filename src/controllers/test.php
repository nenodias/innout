<?php
session_start();
requiredValidSession();

print_r(getLastDayOfMonth("2019-08-04"));