<?php
class CustomerOrder
{
    private $orderID;
    private $customerID;
    private $orderDate;
    private $total;
    private $deliveryCharge;
    private $deliveryAddressFirstLine;
    private $town;
    private $postcode;
    private $region;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
