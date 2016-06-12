<?php
namespace My;

/**
 * class Product
 *
 * a product has a name, quantity, and price
 */
class Product
{
    public $name;
    public $quantity;
    public $price;

    /**
     * construct one product
     *
     * @param array (name, price, quantity)
     * @return void
     */
    public function __construct($name, $price, $quantity = 0)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }
}