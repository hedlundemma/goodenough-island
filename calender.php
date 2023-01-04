<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;



$calendar1 = new Calendar();
$calendar2 = new Calendar();
$calendar3 = new Calendar();


$calendarArray = [
    ['room' => 1, 'calendar' => $calendar1],
    ['room' => 2, 'calendar' => $calendar2],
    ['room' => 3, 'calendar' => $calendar3]
];

foreach ($calendarArray as $key => $calendar) {
    $calendar = $calendar['calendar'];

$calendar->stylesheet();
$calendar->useMondayStartingDate();

}

function bookedDays( array $calendarArray)
{

    $database = connect('/hotel.db');

    $statement = $database->query('SELECT reservations.date_arraving, reservations.date_leaving, reservations.room_id, rooms.room, rooms.cost FROM reservations INNER JOIN rooms ON rooms.id=reservations.room_id');

    $statement->execute();
    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($reservations)) {
        $mask = true;
    }
    foreach ($calendarArray as $calendar){
    foreach ($reservations as $event) {

        if ($event['room_id'] === $calendar['room']) {
        $calendar['calendar']->addEvent($event['date_arraving'], $event['date_leaving'], false, $mask,  $event['cost']);
        }
    }
}
};

bookedDays($calendarArray);