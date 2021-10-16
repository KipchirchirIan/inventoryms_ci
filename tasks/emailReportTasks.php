<?php
use Crunz\Schedule;

$schedule = new Schedule();

$task = $schedule->run("cd public && php index.php admin dashboard email checkout_report");
$task->everyFiveMinutes();

return $schedule;
