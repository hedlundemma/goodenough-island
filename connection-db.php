<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';
require __DIR__ . '/functions.php';


function available()
{


    if (isset($_POST['fName'], $_POST['lName'], $_POST['transferCode'], $_POST['dateArraving'], $_POST['dateLeaving'], $_POST['rooms'])) {

        $fname = trim(htmlspecialchars($_POST['fName'], ENT_QUOTES));
        $lname = trim(htmlspecialchars($_POST['lName'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));
        $dateArraving = trim(htmlspecialchars($_POST['dateArraving'], ENT_QUOTES));
        $dateLeaving = trim(htmlspecialchars($_POST['dateLeaving'], ENT_QUOTES));
        $rooms = $_POST['rooms'];

        $rooms = intval($rooms);





        if (checkFreeDate($dateArraving, $dateLeaving, $rooms)) {
            if (empty($fname)) {
                echo "Enter your first name";
                return false;
            }
            if (empty($lname)) {
                echo "Enter your last name";
                return false;
            }


            if (isValidUuid($transferCode)) {


                // function to count total cost of the reservation
                $totalCost = totalCost($rooms, $dateArraving, $dateLeaving);

                $transferCodeCorrect = transferCode($transferCode, $totalCost);

                if ($transferCodeCorrect) {
                    insertToDatabase($fname, $lname, $transferCode, $dateArraving, $dateLeaving, $rooms, $totalCost);

                    getReservationConfirmation($fname, $lname, $dateArraving, $dateLeaving, $totalCost);
                } else {
                    echo "Not enough money";
                }
            } else {
                echo "invalid transfer code";
            }
        } else {
            echo "Date not good";
        }
    }
};
