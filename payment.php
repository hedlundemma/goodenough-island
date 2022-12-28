<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$client = new Client([
    'base_uri' => 'https://www.yrgopelago.se/centralbank'
]);

$response = $client->request(
    'POST',
    'https://www.yrgopelago.se/centralbank',
    [
        'form_params' => [
            'transferCode' => '34fae872-9d3e-4fa1-aef9-f98b400239be',
            'totalcost' => 20
        ]
    ]
);



if ($response->hasHeader('Content-Length')) {
    $transfer_code = json_encode($response->getBody()->getContents());
    var_dump($transfer_code);
}





// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://www.yrgopelago.se/centralbank/transferCode');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $data = curl_exec($ch);

// curl_close($ch);

// var_dump($data);