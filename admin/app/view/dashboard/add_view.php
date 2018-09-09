<?php if(!defined('BASE_PATH_ADMIN')){ die('Ban khong co quyen truy cap'); } ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add user</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <?php if(!empty($errorsAdd)): ?>
            <div class="col-lg-12 mt-5">
                <ul>
                <?php foreach($errorsAdd as $err): ?>
                    <?php if(!empty($err)): ?>
                        <li style="color:red;"><?= $err; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <h2 class="text-center">Add user</h2>
                <?php if($err === 'err'): ?>
                    <h3 style="color: red;">User hoac email da ton tai , vui long chon lai du lieu</h3>
                <?php endif; ?>
                <form class="mt-5" action="?c=dashboard&m=handleAdd" method="POST">
                    <div class="form-group">
                        <label for="user">User</label>
                        <input type="text" name="user" id="user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fname">Fullname</label>
                        <input type="text" name="fname" id="fname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <button type="submit" name="btnAdd" class="btn btn-primary">Add +</button>
                    <a href="?c=dashboard" class="btn btn-info"> List users</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
