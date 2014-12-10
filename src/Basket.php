<?php

class Basket
{
    const LOW_DELIVERY_COST = 2;
    const HIGH_DELIVERY_COST = 3;
    const LOW_DELIVERY_THRESHOLD = 10;
    const VAT = 20;

    /**
     * @var Cost
     */
    private $cost;

    public function __construct()
    {
        $this->cost = new Cost(0.0);
    }

    public function addProductFromCatalogue(\Sku $sku, \Catalogue $catalogue)
    {
        $this->cost = new Cost(
            $this->cost->toFloat() + $catalogue->getProduct($sku)->getCost()->toFloat()
        );
    }

    public function getTotalPrice()
    {
        if (0 >= $this->cost->toFloat()) {
            return $this->cost;
        }

        return new Cost(
          $this->cost->toFloat() +
          $this->getDeliveryCost()->toFloat() +
          $this->getVatCost()->toFloat()
        );
    }

    private function getDeliveryCost()
    {
        if ($this->cost->toFloat() <= self::LOW_DELIVERY_THRESHOLD) {
            return new Cost(self::HIGH_DELIVERY_COST);
        }
        return new Cost(self::LOW_DELIVERY_COST);
    }

    private function getVatCost()
    {
        return new Cost($this->cost->toFloat() / 100 * self::VAT);
    }
}
