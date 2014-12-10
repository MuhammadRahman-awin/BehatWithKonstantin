Feature: Applying VAT and a delivery costs to the basket
  In order to be more confident in making a purchase
  As a customer
  I need VAT and a cost of delivery to be calculated for my basket

  Rules:
    - VAT is 20%
    - Delivery cost for a basket > £10 is £2
    - Delivery cost for a basket < £10 is £3

  @critical
  Scenario: Product costing less than £10 results in delivery cost of £3
    Given a product with SKU "RS1" and a cost of £5 was added to the catalogue
    When I add the product with SKU "RS1" from the catalogue to my basket
    Then the total price of my basket should be £9

  Scenario: Product costing more than £10 results in delivery cost of £2
    Given a product with SKU "RS2" and a cost of £15 was added to the catalogue
    When I add the product with SKU "RS2" from the catalogue to my basket
    Then the total price of my basket should be £20

  Scenario: Product costing exactly £10 results in delivery cost of £3
    Given a product with SKU "RS3" and a cost of £10 was added to the catalogue
    When I add the product with SKU "RS3" from the catalogue to my basket
    Then the total price of my basket should be £15

  Scenario: Product costing £10 with added VAT still results in delivery cost of £3
    Given a product with SKU "RS4" and a cost of £9 was added to the catalogue
    When I add the product with SKU "RS4" from the catalogue to my basket
    Then the total price of my basket should be £13.8
