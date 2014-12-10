<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class BasketContext implements Context, SnippetAcceptingContext
{

    /**
     * @var Catalogue
     */
    private $catalogue;

    /**
     * @var Basket
     */
    private $basket;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->catalogue = new InMemoryCatalogue();
        $this->basket = new Basket();
    }

    /**
     * @Transform :sku
     */
    public function transformStringToSku($string)
    {
        return new Sku($string);
    }

    /**
     * @Transform :cost
     */
    public function transformStringToCost($string)
    {
        return new Cost(floatval($string));
    }
    
    /**
     * @Given a product with SKU :sku and a cost of £:cost was added to the catalogue
     */
    public function thereIsAProductWithSkuAndACostOfPsInTheCatalogue(Sku $sku, Cost $cost)
    {
        $aProduct = Product::withSkuAndCost($sku, $cost);
        $this->catalogue->addProduct($aProduct);
    }

    /**
     * @When I add the product with SKU :sku from the catalogue to my basket
     */
    public function iAddTheProductWithSkuFromTheCatalogueToMyBasket(Sku $sku)
    {
        $this->basket->addProductFromCatalogue($sku, $this->catalogue);
    }

    /**
     * @Then the total price of my basket should be £:cost
     */
    public function theTotalPriceOfMyBasketShouldBePs($cost)
    {
        PHPUnit_Framework_Assert::assertEquals($cost, $this->basket->getTotalPrice());
    }
}
