<?php
$times = strtotime('+7 hour'); //current timestamp

echo strtotime('-8 hour'); //timestamp 24 hours from now


echo date('h:i A', $times);

$time_given = 1618563600;
$atime= strtotime('-8 hour', $time_given);

echo date('h:i A', $atime);
