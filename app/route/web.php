<?php
// dam bao rang nguoi dung phai truy cap qua file index - khong duoc phep truy cap truc tiep vao day
if(!defined('BASE_PATH')){
    die('Cannot access');
}

class Route
{
    public function home()
    {
        require 'app/controller/homecontroller.php';
    }

    public function product()
    {
        require 'app/controller/productcontroller.php';
    }

    public function __call($r, $q)
    {
        echo "Not Found page \n";
    }
}

$route = new Route;
// can bat duoc tham so tren url cua trinh duyet (chinh la request ma nguoi dung gui len)
// ?c=home&m=index
// c : ten cua controller
// m : ten method nam trong controller
$c = $_GET['c'] ?? 'home';
// dieu huong di vao controller
$route->$c();
