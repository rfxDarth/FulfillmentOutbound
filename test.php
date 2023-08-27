<?php
namespace App;
use SellingPartnerApi\Configuration;

require_once 'vendor/autoload.php';

$config = new Configuration([
    "lwaClientId" => "",
    "lwaClientSecret" => "",
    "lwaRefreshToken" => "",
    "awsAccessKeyId" => "",
    "awsSecretAccessKey" => "",
    "lwaAuthUrl" => 'https://9ba32d54-4d39-4db7-8068-3fa799f02e55.mock.pstmn.io/auth/o2/token',
    "endpoint" => [
        'url' => 'https://9ba32d54-4d39-4db7-8068-3fa799f02e55.mock.pstmn.io',
        'region' => 'postman',
    ],
]);

$service = new ShippingService($config);
$order = new Order(1);
$order->load();
$buyer = new Buyer();
$response = $service->ship($order, $buyer);
var_dump($response);