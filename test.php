<?php
echo strtotime('+7 hour'); //current timestamp

echo strtotime('+32 hour'); //timestamp 24 hours from now

$timestamp = strtotime('today midnight');
$timestamp = strtotime('+8 hour');
echo $timestamp;

$timestamp2 = strtotime('tomorrow midnight');
$timestamp2 = strtotime('+8 hour');

echo $timestamp2;

