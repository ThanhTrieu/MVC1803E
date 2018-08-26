<?php if(!defined('BASE_PATH_ADMIN')){die('Can not acccess');} ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <style type="text/css">
        form{
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3 mt-5">
                <h3 class="text-center mb-5">Admin Login</h3>
                <form action="?c=login&m=handleLogin" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" >
                    </div>
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>