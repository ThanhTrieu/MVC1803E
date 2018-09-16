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

    public function getAllDataUserByPage($start, $keyword, $limit = 2)
    {
        $data = [];
        $key = "%".$keyword."%";
        $sql = "SELECT * FROM admins AS a WHERE a.username LIKE :user OR a.email LIKE :email LIMIT :start, :limmit";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':user',$key,PDO::PARAM_STR);
            $stmt->bindParam(':email',$key,PDO::PARAM_STR);
            $stmt->bindParam(':start',$start,PDO::PARAM_INT);
            $stmt->bindParam(':limmit',$limit,PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }

        return $data;
    }

    public function getAllDataUser($keyword = '')
    {
        // viet model lay tat du lieu ra
        $data = [];
        $key = "%".$keyword."%";

        $sql = "SELECT * FROM admins AS a WHERE a.username LIKE :user OR a.email LIKE :email";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':user',$key,PDO::PARAM_STR);
            $stmt->bindParam(':email',$key,PDO::PARAM_STR);
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
    public function checkExitsUserAndEmail($user, $email)
    {
        $flag = false;
        $sql = "SELECT a.id FROM admins AS a WHERE a.username = :username OR a.email = :email";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':username', $user, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    $flag = true;
                }
            }
            $stmt->closeCursor();
        }
        return $flag;
    }

    public function addDataAdmin($username, $password, $email, $fullname, $phone, $address)
    {
        $flag = false;
        $status = 1;
        $createtime = date('Y-m-d H:i:s');
        $updatetime = null;
        $sql = "INSERT INTO admins(username, password, email, status, phone, fullname, address, createtime, updatetime) VALUES(:username, :password, :email, :status, :phone, :fullname, :address, :createtime, :updatetime)";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':createtime', $createtime, PDO::PARAM_STR);
            $stmt->bindParam(':updatetime', $updatetime, PDO::PARAM_STR);
            if($stmt->execute()){
                $flag = true;
            }
            $stmt->closeCursor();
        }
        return $flag;
    }
}