<?php
namespace app\controller;

if(!defined('BASE_PATH')){
    die('Cannot access');
}

class Product
{
    public function index()
    {
        echo "This is index of product";
    }

    public function detail()
    {
        require 'app/view/product/product_view.php';
    }

    public function __call($r, $q)
    {
        echo "Not Found page \n";
    }
}
$product = new Product;
$m = $_GET['m'] ?? 'index';
$product->$m();