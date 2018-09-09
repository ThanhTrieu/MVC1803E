<?php
namespace app\helper;

/**
 *
 */
class CommonHelper
{
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