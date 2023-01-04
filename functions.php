<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


// check transfercode
function transferCode(string $transferCode, int $totalCost)
{
    $client = new Client();

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
                'transferCode' => $transferCode,
                'user' => 'Emma'
            ]
        ]


    );
    if ($response->hasHeader('Content-Length')) {
        $deposit= json_decode($response->getBody()->getContents());
    }

    if (isset($deposit->error)) {

        return false;
    } else {
        return true;
    }
};

//function to make sure that the dates are free for booking
function checkFreeDate(string $dateArraving, string $dateLeaving, int $rooms)
{
    //get data from db
    $database = connect('/hotel.db');

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

    if (empty($reservations) && $dateLeaving > $dateArraving) {
        return true;
    }
}

// function to calculate the total cost for the tourist stay
function totalCost(int $rooms, string $dateArraving, string $dateLeaving)
{

    $database = connect('/hotel.db');
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
function insertToDatabase($fname, $lname, $transferCode, $dateArraving, $dateLeaving, $rooms, $totalCost)
{


    $database = connect('/hotel.db');


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
function getReservationConfirmation(string $fname, string $lname, string $dateArraving, string $dateLeaving, int $totalCost)
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



    $getData = file_get_contents(__DIR__ . '/recepit.json');
    $tempArray = json_decode($getData, true);
    array_push($tempArray, $receipt);
    $json = json_encode($tempArray);
    file_put_contents(__DIR__ . '/recepit.json', $json);

    echo json_encode(end($tempArray));




}