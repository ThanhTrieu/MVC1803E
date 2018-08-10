<?php
define("BASE_PATH", 'index.php');
if(file_exists('app/route/web.php')){
    require 'app/route/web.php';
} else {
    die('He thong dang duoc nang cap, vui long quay lai sau');
}