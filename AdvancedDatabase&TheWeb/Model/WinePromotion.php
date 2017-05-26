<?php
class WinePromotion
{
    private $promotionID;
    private $wineID;
    private $validFrom;
    private $validUntil;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
