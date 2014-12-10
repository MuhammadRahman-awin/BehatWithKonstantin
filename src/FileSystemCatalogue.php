<?php

class FileSystemCatalogue implements \Catalogue
{

    public function addProduct(\Product $aProduct)
    {
        file_put_contents('/tmp/product', serialize($aProduct));
    }

    public function getProduct(\Sku $sku)
    {
        return unserialize(file_get_contents('/tmp/product'));
    }

    public function getAllProducts()
    {
        return array(unserialize(file_get_contents('/tmp/product')));
    }
} 
