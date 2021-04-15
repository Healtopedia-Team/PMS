<?php
$times = strtotime('+7 hour'); //current timestamp

echo strtotime('+32 hour'); //timestamp 24 hours from now

$timestamp = strtotime('today midnight');
echo $timestamp;

$timestamp2 = strtotime('tomorrow midnight +8 hour');
echo $timestamp2;

echo date('h:i A', $times);

