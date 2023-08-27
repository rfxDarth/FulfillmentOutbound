<?php
namespace App;
use App\Data\BuyerInterface;

//Why do we even need this one? @ka
class Buyer implements BuyerInterface
{
    public int $country_id;
    public string $country_code;
    public string $country_code3;
    public string $name;
    public string $shop_username;
    public string $email;
    public string $phone;
    public string $address;
    public array $data;

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        $this->$offset = null;
    }
}