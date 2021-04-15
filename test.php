<?php
//timestamp 24 hours from now
$timestamp = strtotime('today midnight +8 hour');
echo $timestamp;
$timestamp2 = strtotime('tomorrow midnight +8 hour');
echo $timestamp2;
