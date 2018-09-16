<?php
namespace app\controller;

if(!defined('BASE_PATH_ADMIN')){
    die('Ban khong co quyen truy cap');
}

require 'app/core/MY_Controller.php';
use app\core\MY_Controller;
require 'app/model/login_model.php';
use app\model\LoginModel;
use app\helper\CommonHelper;

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
        // xu ly search data
        $keyword = $_GET['s'] ?? '';
        $keyword = strip_tags($keyword);
        $page = $_GET['page'] ?? '';
        $page = (is_numeric($page) && $page > 0) ? $page : 1;

        $link = [
            'c'=>'dashboard',
            'm'=>'index',
            'page' => '{page}',
            's'=>$keyword
        ];

        $myLinks = CommonHelper::createLink($link);
        $countlstUser = $this->user->getAllDataUser($keyword);

        $panigation = CommonHelper::panigation(count($countlstUser), $page, $myLinks, $keyword);

        $lstUser = $this->user->getAllDataUserByPage($panigation['start'], $keyword, $panigation['limit']);

        // xoa bo loi phan add user
        if(isset($_SESSION['errUsers'])){
            unset($_SESSION['errUsers']);
        }

        require 'app/view/dashboard/index_view.php';
    }

    public function delete()
    {
        $idUser = $_GET['id'] ?? '';
        $idUser = is_numeric($idUser) ? $idUser : 0;
        $del = $this->user->deleteAdminById($idUser);
        header("Location:?c=dashboard");
    }

    public function add()
    {
        // hien thi form nhap du lieu
        $errorsAdd = $_SESSION['errUsers'] ?? [];
        $err = $_GET['state'] ?? '';
        require 'app/view/dashboard/add_view.php';
    }

    public function handleAdd()
    {
        if(isset($_POST['btnAdd'])){
            $username = $_POST['user'] ?? '';
            $username = strip_tags($username);
            $password = $_POST['password'] ?? '';
            $password = strip_tags($password);
            $email = $_POST['email'] ?? '';
            $email = strip_tags($email);
            $fullname = $_POST['fname'] ?? '';
            $fullname = strip_tags($fullname);
            $phone = $_POST['phone'] ?? '';
            $phone = strip_tags($phone);
            $address = $_POST['address'] ?? '';

            // kiem tra xem du lieu gui len co hop le hay ko
            $checkAdd = CommonHelper::validateUserAdmin($username, $password, $email, $fullname, $phone, $address);
            $flagCheck = true;
            foreach ($checkAdd as $key => $val) {
                if(!empty($val)){
                    $flagCheck = false;
                    break;
                }
            }
            // neu $flagCheck = true : nguoi dung nhap dung du lieu - nguoc lai nguoi dung nhap sai du lieu
            if($flagCheck){
                // truong hop nguoi dung nhap dung
                // can xoa bo session chua loi
                if(isset($_SESSION['errUsers'])){
                    unset($_SESSION['errUsers']);
                }
                // thuc hien luu du lieu vao database
                // kiem tra xem username va email co ton tai trong database chua ? neu chua cho add nguoc lai bao loi va khong cho add
                $chkExitsData = $this->user->checkExitsUserAndEmail($username, $email);
                if($chkExitsData){
                    // khong cho add
                    header("Location:?c=dashboard&m=add&state=err");
                } else {
                    // add vao db
                    $add = $this->user->addDataAdmin($username, $password, $email, $fullname, $phone, $address);
                    if($add){
                        // add thanh cong vao db
                        header("Location:?c=dashboard");
                    } else {
                        header("Location:?c=dashboard&m=add&state=fail");
                    }
                }
            } else {
                // truong hop nguoi dung nhap sai du lieu
                // gan loi sai do vao session
                $_SESSION['errUsers'] = $checkAdd;
                // quay ve lai dung form add
                header("Location:?c=dashboard&m=add");
            }
        }
    }

    public function __call($r,$q)
    {
        echo "Not found Request";
    }
}

$dash = new DashboardController();
$m = $_GET['m'] ?? 'index';
$dash->$m();