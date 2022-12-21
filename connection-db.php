<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';

$database = connect('/hotel.db');

$statement = $database->query('SELECT * FROM reservations');


$reservations = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['fName'], $_POST['lName'], $_POST['transferCode'], $_POST['dateArraving'], $_POST['dateLeaving'], $_POST['rooms'])) {

                    $fname = trim(htmlspecialchars($_POST['fName'], ENT_QUOTES));
                    $lname = trim(htmlspecialchars($_POST['lName'], ENT_QUOTES));
                    $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
                    $dateArraving = trim(htmlspecialchars($_POST['dateArraving'], ENT_QUOTES));
                    $dateLeaving = trim(htmlspecialchars($_POST['dateLeaving'], ENT_QUOTES));
                    $rooms = trim(htmlspecialchars($_POST['rooms'], ENT_QUOTES));

                    // If dates abd room are available and if transfer code is valid

                    $query = 'INSERT INTO reservations (f_name, l_name, transfer_code, date_arraving, date_leaving, room_id) VALUES (:f_name, :l_name, :transfer_code, :date_arraving, :date_leaving, :room_id)';

                    $statement = $database->prepare($query);

                    $statement->bindParam(':f_name', $fname, PDO::PARAM_STR);
                    $statement->bindParam(':l_name', $lname, PDO::PARAM_STR);
                    $statement->bindParam(':transfer_code', $transferCode, PDO::PARAM_INT);
                    $statement->bindParam(':date_arraving', $dateArraving, PDO::PARAM_STR);
                    $statement->bindParam(':date_leaving', $dateLeaving, PDO::PARAM_STR);
                    $statement->bindParam(':room_id', $rooms, PDO::PARAM_INT);

                    $statement->execute();
}