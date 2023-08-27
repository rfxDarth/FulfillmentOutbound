<?php
namespace App;
use SellingPartnerApi\Configuration;
use SellingPartnerApi\Endpoint;

require_once 'vendor/autoload.php';

$config = new Configuration([
    "lwaClientId" => "<LWA client ID>",
    "lwaClientSecret" => "<LWA client secret>",
    "lwaRefreshToken" => "<LWA refresh token>",
    "awsAccessKeyId" => "<AWS access key ID>",
    "awsSecretAccessKey" => "<AWS secret access key>",
    "endpoint" => Endpoint::EU_SANDBOX,
]);

$service = new ShippingService($config);
$order = new Order(1);
$order->load();
$buyer = new Buyer();
$response = $service->ship($order, $buyer);
var_dump($response);