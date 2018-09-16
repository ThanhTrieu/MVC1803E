<?php if(!defined('BASE_PATH_ADMIN')){ die('Ban khong co quyen truy cap'); } ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <script src="../public/js/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Hello <?= $username; ?></h2>
                <a href="?c=login&m=logout" class="btn btn-info">Logout</a>
            </div>
            <hr>
            <div class="col-lg-12 mt-5">
                <a class="btn btn-primary" href="?c=dashboard&m=add">Add user + </a>

                <input style="width: 400px;height: 35px;" type="text" name="txtSearch" id="txtSearch">

                <button id="btnSearch" type="button" class="btn btn-info">Search</button>

                <button class="btn btn-success" id="viewAll" type="button">View All</button>

                <table class="table table-striped table-bordered mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($lstUser as $key => $item): ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $item['username']; ?></td>
                            <td><?= $item['fullname']; ?></td>
                            <td><?= $item['email']; ?></td>
                            <td><?= $item['phone']; ?></td>
                            <td><?= $item['address']; ?></td>
                            <td>
                                <a class="btn btn-primary" href="#">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="?c=dashboard&m=delete&id=<?= $item['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $panigation['panigation']; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // bat su kien vao nut search
        $(function(){

            $('#viewAll').click(function(){
                window.location.href = "?c=dashboard";
            });

            $('#btnSearch').click(function(){
                // lay keyword ma nguoi dung nhap vao
                let keyword = $('#txtSearch').val().trim();
                //alert(keyword);
                if(keyword != '' && keyword.length > 3){
                    window.location.href = "?c=dashboard&s=" + keyword + "&page=<?php echo $page; ?>";
                }
                return false; // dung het ko lam gi nua
            });
        });
    </script>
</body>
</html>