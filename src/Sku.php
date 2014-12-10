<?php

class Sku
{
    /**
     * @var string
     */
    private $sku;

    public function __construct($sku)
    {
        $this->sku = $sku;
    }

    public function __toString()
    {
        return $this->sku;
    }
}

