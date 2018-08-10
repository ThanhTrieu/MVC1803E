<?php
namespace app\controller;

if(!defined('BASE_PATH')){
    die('Cannot access');
}

class HomeController
{
    public function home()
    {
        //echo "This is " . __FUNCTION__ . " of " . __CLASS__;

        require 'app/view/home/home_view.php';
    }

    public function add()
    {
        if(isset($_POST['btnSub'])){
            echo "<pre>";
            print_r($_POST);
        }
    }

    public function __call($r, $q)
    {
        echo "Not Found page \n";
    }
}

// can bat dc tham so goi den cac method trong controller
// ?c=home&m=index
$home = new HomeController;
$m = $_GET['m'] ?? 'home';
$home->$m();