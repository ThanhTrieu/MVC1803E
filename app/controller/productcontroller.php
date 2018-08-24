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

        //$data = $this->db->getAllDataProduct();
        //$data2 = $this->db->getInfoProductById($id );
        //echo "<pre>";
        //print_r($data2);
        //$data = $this->db->getInfoData($id);
        // $data : bao gom : ten dang muc san pham, ten nha san xuat san pham, ten he dieu hanh cua san pham, ten san pham
        // cho thay biet san pham co id = 1 thuoc danh muc nao ?  nha san xuat la ai ? ten he dieu hanh la gi?
        //echo "<pre>";
        //print_r($data);
        $keyword = $_GET['key'] ?? '';
        $keyword = strip_tags($keyword);
        $data = $this->db->findDataByKeyword($keyword);
        echo "<pre>";
        print_r($data);
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