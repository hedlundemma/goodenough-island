<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


// check transfercode
function transferCode(string $transferCode, int $totalCost) : bool
{
    $client = new Client();
// send a request to yrgopelago
    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/transferCode',
        [
            'form_params' => [
                'transferCode' => $transferCode,
                'totalcost' => $totalCost
            ]
        ]


    );
    if ($response->hasHeader('Content-Length')) {
        $transfer_code = json_decode($response->getBody()->getContents());
    }

    if (isset($transfer_code->error)) {

        return false;
    } else {
        return true;
    }
};

// make sure that the deposit gets into my account
function checkDeposit(string $transferCode)
{
    $client = new Client();

    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/deposit',
        [
            'form_params' => [
                'user' => 'Emma',
                'transferCode' => $transferCode

            ]
        ]


    );
    if ($response->hasHeader('Content-Length')) {
        $deposit= json_decode($response->getBody()->getContents());
    }

    if (isset($deposit->message)) {

        return true;
    } else {
        return false;
    }


};

//function to make sure that the dates are free for booking
function checkFreeDate(string $dateArraving, string $dateLeaving, int $rooms)
{
    //get data from db
    $database = connect('/hotel.db');
 // query to make sure that the date for the room choosen is available
    $statement = $database->prepare('SELECT * FROM reservations
    WHERE
    room_id = :room_id
    AND
    (date_arraving <= :date_arraving
    or date_arraving < :date_leaving)
    AND
    (date_leaving> :date_arraving or
    date_leaving> :date_leaving)');



    $statement->bindParam(':room_id', $rooms, PDO::PARAM_INT);
    $statement->bindParam(':date_arraving', $dateArraving, PDO::PARAM_STR);
    $statement->bindParam(':date_leaving', $dateLeaving, PDO::PARAM_STR);

    $statement->execute();

    $reservations = $statement->fetchAll(PDO::FETCH_ASSOC);

    // if the dates are available
    if (empty($reservations) && $dateLeaving > $dateArraving) {
        return true;
    }
}

// function to calculate the total cost for the tourist stay
function totalCost(int $rooms, string $dateArraving, string $dateLeaving) : int|bool
{

    $database = connect('/hotel.db');
    // sql query
    $stmnt = $database->prepare('SELECT cost FROM rooms WHERE id = :room_id');
    $stmnt->bindParam(':room_id', $rooms, PDO::PARAM_INT);
    $stmnt->execute();

    $cost = $stmnt->fetch(PDO::FETCH_ASSOC);

    $cost = $cost['cost'];

    //counts the total cost of the booking
    $totalCost = (((strtotime($dateLeaving) - strtotime($dateArraving)) / 86400) * $cost);
    return $totalCost;
}


// function to insert the tourist info to the database
function insertToDatabase($fname, $lname, $transferCode, $dateArraving, $dateLeaving, $rooms, $totalCost) : void
{


    $database = connect('/hotel.db');

    // sql query that inserts the values from the form to the database

    $query = 'INSERT INTO reservations (f_name, l_name, transfer_code, date_arraving, date_leaving, room_id, total_cost) VALUES (:f_name, :l_name, :transfer_code, :date_arraving, :date_leaving, :room_id, :total_cost)';

    $statement = $database->prepare($query);

    $statement->bindParam(':f_name', $fname, PDO::PARAM_STR);
    $statement->bindParam(':l_name', $lname, PDO::PARAM_STR);
    $statement->bindParam(':transfer_code', $transferCode, PDO::PARAM_STR);
    $statement->bindParam(':date_arraving', $dateArraving, PDO::PARAM_STR);
    $statement->bindParam(':date_leaving', $dateLeaving, PDO::PARAM_STR);
    $statement->bindParam(':room_id', $rooms, PDO::PARAM_INT);
    $statement->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);

    $statement->execute();
};

// function to get the reservation confirmation as a json
function getReservationConfirmation(string $fname, string $lname, string $dateArraving, string $dateLeaving, int $totalCost) : void
{
    $receipt = [
        'island' => "Albero",
        'hotel' => "Tree-hotel",
        'f_name' => $fname,
        'l_name' =>$lname,
        'arrival_date' => $dateArraving,
        'departure_date' => $dateLeaving,
        'total_cost' => $totalCost,
        'stars' => "1"

    ];



    $getJson = file_get_contents(__DIR__ . '/recepit.json');
    $temporaryArray = json_decode($getJson, true);
    array_push($temporaryArray, $receipt);
    $json = json_encode($temporaryArray);
    file_put_contents(__DIR__ . '/recepit.json', $json);

    //get the last recepit
    echo "Thank you for making a reservation at Tree Hotel" . " " . $fname . " "  . $lname .  "." . " " . "Here is your recepit for your future stay at us<br>";
    echo json_encode(end($temporaryArray));




}