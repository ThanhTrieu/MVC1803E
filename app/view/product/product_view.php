<?php if(!defined('BASE_PATH')) { die('can not access'); } ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Demo MVC</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h1 class="text-center">Hello You - MVC - Procuct !</h1>
                <hr/>
                <ul>
                    <li>
                        <a href="?c=product&m=detail"> Product </a>
                    </li>
                    <li>
                        <a href="?c=home"> Contact </a>
                    </li>
                    <li>
                        <a href="?c=product&m=order"> About </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>