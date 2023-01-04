<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

$rooms = [
    'room' => 1,
    'room' => 2,
    'room' => 3
]

$calendar1 = new Calendar();
$calendar2 = new Calendar();
$calendar3 = new Calendar();
$calendar1->stylesheet();
$calendar1->useMondayStartingDate();

function bookedDays($calendar1)
{

    $database = connect('/hotel.db');

    $statement = $database->query('SELECT reservations.date_arraving, reservations.date_leaving, reservations.room_id, rooms.room, rooms.cost FROM reservations INNER JOIN rooms ON rooms.id=reservations.room_id');

    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($reservations)) {
        $mask = true;
    }
    foreach ($reservations as $event) {
        if ($event['room_id'] === 1) {
            $calendar1->addEvent($event['date_arraving'], $event['date_leaving'], false, $mask,  $event['cost']);
        }
    }
}

bookedDays($calendar1);
