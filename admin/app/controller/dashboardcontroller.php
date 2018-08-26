<?php
namespace app\controller;

if(!defined('BASE_PATH_ADMIN')){
    die('Ban khong co quyen truy cap');
}

require 'app/core/MY_Controller.php';
use app\core\MY_Controller;
require 'app/model/login_model.php';
use app\model\LoginModel;

class DashboardController extends MY_Controller
{
    private $user;
    public function __construct()
    {
        if($this->checkAdminLogin()){
            header("Location:?c=login");
            die;
        }
        $this->user = new LoginModel();
    }

    public function index()
    {
        $username = $_SESSION['user'] ?? '';
        $lstUser = $this->user->getAllDataUser();

        require 'app/view/dashboard/index_view.php';
    }

    public function delete()
    {
        $idUser = $_GET['id'] ?? '';
        $idUser = is_numeric($idUser) ? $idUser : 0;
        $del = $this->user->deleteAdminById($idUser);
        header("Location:?c=dashboard");
    }

    public function __call($r,$q)
    {
        echo "Not found Request";
    }
}

$dash = new DashboardController();
$m = $_GET['m'] ?? 'index';
$dash->$m();