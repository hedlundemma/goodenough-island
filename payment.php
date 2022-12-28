<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$client = new Client();

$transferCode = trim(htmlspecialchars($_POST['transferCode'], ENT_QUOTES));

$response = $client->request(
    'POST',
    'https://www.yrgopelago.se/centralbank/transferCode',
    [
        'form_params' => [
            'transferCode' => $transferCode,
            'totalcost' => 1
        ]
    ]


);





if ($response->hasHeader('Content-Length')) {
    $transfer_code = json_decode($response->getBody()->getContents());
}