<?php
namespace app\core;

if(!defined('BASE_PATH_ADMIN')){
    die('Ban khong co quyen truy cap');
}

class MY_Controller
{
    protected function getSessionIdAdmin()
    {
        $id = $_SESSION['id'] ?? '';
        $id = is_numeric($id) ? $id : 0;
        return $id;
    }

    protected function getSessionUserAdmin()
    {
        $username = $_SESSION['user'] ?? '';
        return $username;
    }

    protected function checkAdminLogin()
    {
        if($this->getSessionIdAdmin() <= 0 || !$this->getSessionUserAdmin()){
            // nguoi dung chua dang nhap
            return true;
        }
        return false;
    }
}