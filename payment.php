<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$client = new Client();


$response = $client->request(
    'POST',
    'https://www.yrgopelago.se/centralbank/transferCode',
    [
        'form_params' => [
            'transferCode' => '11090a06-6b29-4609-96fc-4ee2f14a8048',
            'totalcost' => 20
        ]
    ]
);



if ($response->hasHeader('Content-Length')) {
    $transfer_code = json_encode($response->getBody()->getContents());
}





// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://www.yrgopelago.se/centralbank/transferCode');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $data = curl_exec($ch);

// curl_close($ch);

// var_dump($data);