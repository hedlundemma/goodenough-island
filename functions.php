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