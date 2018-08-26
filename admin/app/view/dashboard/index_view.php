<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
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
                <a class="btn btn-primary" href="#">Add user + </a>
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
            </div>
        </div>
    </div>
</body>
</html>