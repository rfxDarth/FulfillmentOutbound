<?php

namespace App;
use App\Data\AbstractOrder;
use JsonException;
use RuntimeException;

//Since we don't have any actual data, let this be the mocking class
class Order extends AbstractOrder
{
    protected function loadOrderData(int $id): array
    {
        try {
            return json_decode(file_get_contents('mock/order.16400.json'), true, 16, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException('Malformed mock json provided: ' . $e->getMessage());
        }
    }
}