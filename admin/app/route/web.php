<?php
if(!defined('BASE_PATH_ADMIN')){
    die('Ban khong co quyen truy cap');
}

class Route
{
    public function login()
    {
        //echo "This is login";
        require 'app/controller/logincontroller.php';
    }

    public function dashboard()
    {
        require 'app/controller/dashboardcontroller.php';
    }

    public function __call($r,$q)
    {
        echo "Not found method";
    }
}

$c = $_GET['c'] ?? 'login';
$route = new Route();
$route->$c();