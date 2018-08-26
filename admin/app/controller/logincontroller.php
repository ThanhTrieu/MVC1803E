<?php
namespace app\controller;

if(!defined('BASE_PATH_ADMIN')){
    die('Ban khong co quyen truy cap');
}

require 'app/model/login_model.php';
use app\model\LoginModel;

class LoginController
{
    private $user;
    function __construct()
    {
        $this->user = new LoginModel();
    }

    public function index()
    {
        //echo "This is login";
        require 'app/view/login/index_view.php';
    }

    public function handleLogin()
    {
        if(isset($_POST['login'])){
            $user = $_POST['username'] ?? '';
            $user = strip_tags($user);

            $pass = $_POST['password'] ?? '';
            $pass = strip_tags($pass);

            if(empty($user) || empty($pass)){
                header('Location:?c=login&state=fail');
            } else {
                // kiem tra user va mat khau co ton tain trong database ko?
                $infoUser = $this->user->checkLoginAdmin($user, $pass);
                if(isset($infoUser['id']) && !empty($infoUser)){
                    // chung to no co ton tai
                    // luu gia tri cua nguoi dung vao session de tien cho cac cong viec sau nay
                    $_SESSION['user'] = $infoUser['username'];
                    $_SESSION['email'] = $infoUser['email'];
                    $_SESSION['id'] = $infoUser['id'];
                    $_SESSION['phone'] = $infoUser['phone'];
                    // dieu huong ve trang nao
                    header("Location:?c=dashboard");
                } else {
                    header('Location:?c=login&state=err');
                }
            }
        }
    }

    public function logout()
    {
        // huy session
        session_destroy();
        header("Location:?c=login");
    }

    public function __call($r,$q)
    {
        echo "Not found Request";
    }
}

$login = new LoginController();
$m = $_GET['m'] ?? 'index';
$login->$m();