<?php
namespace app\controller;

if(!defined('BASE_PATH')){
    die('Cannot access');
}
// nap Usermodel vao controller - su dung dc cac phuong cua model do trong phia controller
require 'app/model/user_model.php';
use app\model\UserModel;

class UserController
{
    private $user;
    function __construct()
    {
        // khoi doi tuong cho class UserModel
        // de sau nay bat ky cho nao trong class controller deu trieu goi dc cac phuong thuc trong model thong qua thang $this->user;
        $this->user = new UserModel();
    }

    public function index()
    {
        echo "This is usercontroller.php - index";
    }

    public function test()
    {
        //echo "This is usercontroller.php";
        $action = $_GET['ac'] ?? 'create';

        if($action === 'create'){
            // thuc hien insert data ma ben phia model da viet san
            // can tao du lieu test de insert
            $username = "admin123";
            $password = "123456789";
            $email = "admin123@gmail.com";
            $status = 1;
            $phone = "09876543";
            $fullname = "test 123";
            $add = "Ha Noi";
            $ct = date('Y-m-d H:i:s');
            $ut = null;
            $insert = $this->user->insertUserAdmin($username, $password, $email, $status, $phone, $fullname, $add, $ct, $ut);
            if($insert){
                echo "Success";
            } else {
                echo "Fail";
            }
        } elseif($action === 'edit'){
            $idUser = $_GET['id'] ?? '';
            $idUser = is_numeric($idUser) ? $idUser : 0;
            if($idUser > 0){
                $newPass = 'lphp1803E2';
                $up = $this->user->updatePasswordByUser($idUser, $newPass);
                if($up){
                    echo "Update Thanh Cong";
                } else {
                    echo "Update That bai";
                }
            } else {
                echo "Ban khong co quyen update";
            }
        } elseif($action === 'delete'){
            $id = $_GET['id'] ?? '';
            $id = is_numeric($id) ? $id : 0;
            if($id){
                $del = $this->user->deleteAdminById($id);
                if($del){
                    echo "Xoa thanh cong";
                } else {
                    echo "Xoa that bai";
                }
            } else {
                echo "Ban khong co quyen xoa";
            }
        }
    }

    public function __call($r, $q)
    {
        echo "Not Found page \n";
    }
}

$user = new UserController();
$m = $_GET['m'] ?? 'index';
$user->$m();