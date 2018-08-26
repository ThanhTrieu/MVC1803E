<?php
namespace app\model;

if(!defined('BASE_PATH_ADMIN')){
    die('Ban khong co quyen truy cap');
}

require 'app/config/database.php';
use app\config\Database;
use \PDO;

class LoginModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllDataUser()
    {
        // viet model lay tat du lieu ra
        $data = [];
        $sql = "SELECT * FROM admins";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        return $data;
    }

    public function deleteAdminById($id){
        $flag = false;
        $sql = "DELETE FROM admins WHERE id = :id";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                $flag = true;
            }
            $stmt->closeCursor();
        }
        return $flag;
    }

    public function checkLoginAdmin($user, $pass)
    {
        // viet cho thay model kiem tra xem nguoi dung co nhap ko?
        $data = [];
        $sql = "SELECT * FROM admins AS a WHERE a.username = :user AND a.password = :pass AND a.status = 1 LIMIT 1";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':user', $user, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        return $data;
    }
}