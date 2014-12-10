<?php

class InMemoryCatalogue implements Catalogue
{
    private $product;

    public function addProduct(\Product $aProduct)
    {
        $this->product = $aProduct;
    }

    public function getProduct(\Sku $sku)
    {
        return $this->product;
    }

    public function getAllProducts()
    {
        if (! empty($this->product)) {
            return array();
        }

        return array($this->product);
    }
}
