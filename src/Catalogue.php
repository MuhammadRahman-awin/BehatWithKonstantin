<?php 

interface Catalogue
{
    public function addProduct(\Product $product);
    public function getProduct(\Sku $sku);
    public function getAllProducts();
}
