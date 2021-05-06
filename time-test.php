<?php
$dt = new DateTime();
echo $dt->format('Y-m-d H:i:s');

$timestamp = strtotime('today midnight +8 hour');
$timestamp2 = strtotime('tomorrow midnight +8 hour');

echo $timestamp;
echo $timestamp2;