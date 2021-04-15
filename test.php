<?php
$times = strtotime('+7 hour'); //current timestamp

echo strtotime('-8 hour'); //timestamp 24 hours from now


echo date('h:i A', $times);

$time_given = 1618563600;
echo date('h:i A',strtotime('-8 hours',strtotime($time_given)));
