<?php

require_once __DIR__ . '/../vendor/autoload.php';


$app = new Silex\Application();
$app['debug'] = true;

$app->get(
  '/catalogue',
  function() {
      $catalogue = new FileSystemCatalogue();

      $products = $catalogue->getAllProducts();

      foreach($products as $product) {
          if ($product) {
              $html = "<div class='product'> -> {$product->getSku()}
                <a href='/basket/add/{$product->getSku()}'>Add to my basket</a></div>";
              return $html;
          }
          return 'No Product Found';
      }
  }
);

$app->get(
    '/basket/add/{sku}',
    function($sku) {
        $catalogue = new FileSystemCatalogue();
        $basket = new Basket();
        $basket->addProductFromCatalogue(new Sku($sku), $catalogue);

        return "Basket Price: £". $basket->getTotalPrice();
    }
);

$app->run();
