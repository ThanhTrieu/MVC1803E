<?php
namespace app\model;
require 'app/config/database.php';
use app\config\Database;
use \PDO;

 /**
  * noi xu ly du lieu tu mysql tra ve
  */
class ProductModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllDataProduct()
    {
        $data = [];
        // hoc cach xu ly du lieu mysql voi pdo php
        // khai bao cau lenh sql
        $sql = "SELECT * FROM products";
        // prepare : kiem tra tinh hop le cua cau lenh sql
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            // cac cau lenh sql khong co loi cu phap
            // thuc thi cau lenh sql
            if($stmt->execute()){
                // kiem tra xem co du lieu tra ve hay ko
                if($stmt->rowCount() > 0){
                    // fetchAll: giup lay tat ca cac dong du lieu trong db ra
                    // PDO::FETCH_ASSOC:  tra ve 1 mang khong tuan voi key se chinh la cac truong nam trong db
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            // ngat ket noi toi prepare;
            $stmt->closeCursor();
        }
        return $data;
    }

    public function getInfoProductById($id)
    {
        $data = [];
        $sql = "SELECT * FROM products AS a WHERE a.id = :id";
        $stmt = $this->pd->prepare($sql);
        if($stmt){
            // kiem tra tham so truyen vao cau lenh sql
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            // thuc thi cau lenh
            if($stmt->execute()){
                // kiem tra co dl tra ve ko?
                if($stmt->rowCount() > 0){
                    // fecth : lay ra 1 dong du lieu
                    $data = $stmt->fecth(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        return $data;
    }
}