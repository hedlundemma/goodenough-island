<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;



$client = new Client([
    'base_uri' => 'https://www.yrgopelago.se/centralbank'
]);

$response = $client->request(
    'POST',
    'https://www.yrgopelago.se/centralbank/transferCode',
    [
        'form_params' => [
            'transferCode' => 'ab14cbb2-f550-46e6-97c2-bb7f0126733e'
        ]
    ]
);

if ($response->hasHeader('Content-Length')) {
    $transfer_code = json_decode($response->getBody()->getContents());
}