<?php
namespace app\model;
require 'app/config/database.php';
use app\config\Database;
use \PDO;

class UserModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }
    // viet cac ham them - sua - xoa user trong bang admin o day !
    public function insertUserAdmin($username, $pass, $email, $status = 1, $phone = '', $fullname = '', $address = '', $ct = '', $ut = '')
    {
        $checkFlag = false;
        // them 1 user vao bang admin
        $sql = "INSERT INTO admins(username, password, email, status, phone, fullname, address, createtime, updatetime) VALUES (:username, :password, :email, :status, :phone, :fullname, :address, :createtime, :updatetime)";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            // kiem tra du lieu dau vao thong qua cac tham hinh thuc(tham so) trong cau lenh sql
            $stmt->bindParam(':username',$username,PDO::PARAM_STR);
            $stmt->bindParam(':password',$pass,PDO::PARAM_STR);
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->bindParam(':status',$status,PDO::PARAM_INT);
            $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
            $stmt->bindParam(':fullname',$fullname,PDO::PARAM_STR);
            $stmt->bindParam(':address',$address,PDO::PARAM_STR);
            $stmt->bindParam(':createtime',$ct,PDO::PARAM_STR);
            $stmt->bindParam(':updatetime',$ut,PDO::PARAM_STR);
            // thuc thi cau lenh
            if($stmt->execute()){
                $checkFlag = true;
            }
            $stmt->closeCursor();
        }
        return $checkFlag;
    }

    public function updatePasswordByUser($id, $pass)
    {
        $flagCheck = false;
        $sql = "UPDATE admins SET password = :password WHERE id = :id";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            $stmt->bindParam(':password',$pass,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            // thuc thi cau lenh
            if($stmt->execute()){
                $flagCheck = true;
            }
            $stmt->closeCursor();
        }
        return $flagCheck;
    }
}