<?php
session_start();

define('BASE_PATH_ADMIN', 'admin/index.php');
if(file_exists('app/route/web.php')){
    require 'app/helper/common_helper.php';
    require 'app/route/web.php';
} else {
    echo "Ban khong co quyen truy cap";
}