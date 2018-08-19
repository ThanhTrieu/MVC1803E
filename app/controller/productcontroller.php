<?php
namespace app\controller;

if(!defined('BASE_PATH')){
    die('Cannot access');
}

require 'app/model/product_model.php';
use app\model\ProductModel;

class Product
{
    private $db;
    function __construct()
    {
        $this->db = new ProductModel();
    }

    public function index()
    {
        //echo "This is index of product";
        $id = $_GET['id'] ?? 0;

        $data = $this->db->getAllDataProduct();
        $data2 = $this->db->getInfoProductById($id );
        echo "<pre>";
        print_r($data2);
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