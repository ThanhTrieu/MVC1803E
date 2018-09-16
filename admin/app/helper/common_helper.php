<?php
namespace app\helper;

/**
 *
 */
class CommonHelper
{
    const BASE_PATH_PAGE = "index.php";
    const ROW_LIMIT = 2; // 2 san pham tren 1 trang

    public static function createLink($data = [])
    {
        // tao ra 1 duong link bo tro cho ham phan trang
        // giup cho chung ta biet dang phan trang cho chuyen muc hay module nao (user - admin)
        /*
        $data = [
            'c' => 'dashboard',
            'm' => 'index',
            'page' => "{page}",
            's' => '{keyword}'
        ]
         */
        // tao link phan trang
        $links = '';
        foreach ($data as $key => $val) {
            // index.php?c=dashboard&m=index&page={page}&s={keyword}
            $links .= (empty($links)) ? "?".$key."=".$val : "&" . $key . "=" . $val;
        }
        return self::BASE_PATH_PAGE . $links;
    }
    public static function panigation($totalRecord, $currentPage = 1, $linkPage, $keyword = '')
    {
        // viet ham phan trang
        // tinh tong so trang : totalpage
        // totalRecord/rowLimit
        $totalPage = ceil($totalRecord/self::ROW_LIMIT);
        // xac dinh lai pham vi cua current page
        if($currentPage < 1){
            $currentPage = 1;
        } elseif($currentPage > $totalPage){
            $currentPage = $totalPage;
        }
        // tinh start trong cau lenh limit mysql
        $start = ($currentPage - 1) * self::ROW_LIMIT;

        // tao template phan trang voi bootstrap 4
        $htmlPage = '';
        $htmlPage .= "<nav aria-label='Page navigation'>";
        $htmlPage .= "<ul class='pagination'>";
        // xu ly nut back page
        if($currentPage > 1 && $currentPage <= $totalPage){
            // hien thi nut back page
            $htmlPage .= "<li class='page-item'><a class='page-link' href='".str_replace('{page}',$currentPage -1, $linkPage)."'>Previous</a></li>";
        }
        // xu ly cho cac trang o giua
        for($i = 1; $i <= $totalPage; $i++){
            // hien thi active cho trang hien tai ma nguoi dung dang o do
            if($currentPage == $i){
                // active trang hien tai len
                $htmlPage .= "<li class='page-item active'><a class='page-link' href='javascript:void(0)'>".$currentPage."</a></li>";
            } else {
                $htmlPage .= "<li class='page-item'><a class='page-link' href='".str_replace('{page}',$i,$linkPage)."'>".$i."</a></li>";
            }
        }

        // xu ly cho nut next page
        if($currentPage < $totalPage && $currentPage >= 1){
            $htmlPage .= "<li class='page-item'><a class='page-link' href='".str_replace('{page}',$currentPage+1,$linkPage)."'>Next</a></li>";
        }
        $htmlPage .= "</ul>";
        $htmlPage .= "</nav>";

        return [
            'panigation' => $htmlPage,
            'start' => $start,
            'page' => $currentPage,
            's' => $keyword,
            'limit' => self::ROW_LIMIT
        ];
    }

    public static function validateUserAdmin ($username, $password, $email, $fullname, $phone, $address)
    {
        $errors = [];
        $errors['username'] = (empty($username) || strlen($username) > 60) ? 'Vui long nhap username va khong lon hon 60 ki tu' : '';
        $errors['password'] = (empty($password) || strlen($username) > 60) ? 'Vui long nhap password' : '';
        $errors['email'] = filter_var($email,FILTER_VALIDATE_EMAIL) ? '' : 'Vui long nhap dung dinh dang email';
        $errors['fname'] = (empty($fullname)) ? 'Vui long nhap Fullname' : '';
        $errors['phone'] = (empty($phone)) ? 'Vui long nhap so dien thoai' : '';
        $errors['add'] = (empty($address)) ? 'Vui long nhap dia chi' : '';
        return $errors;
    }
}