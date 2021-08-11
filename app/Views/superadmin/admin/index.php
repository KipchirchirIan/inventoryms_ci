<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?= link_tag('assets/modules/bootstrap/css/bootstrap.min.css') ?>
    <?= link_tag('assets/modules/fontawesome/css/all.min.css') ?>

    <title>Super Admin | Login</title>
    <style>
        .form-container {
            width: 70% !important;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="<?= base_url('superadmin') ?>">IMS</a>
</nav>

<div class="container">

    <div class="container text-center pt-3">
        <h2>Hello, <?= session()->get('ims_name') ?></h2>
        <p><a href="<?= base_url('superadmin/logout') ?>">Logout</a></p>
    </div>

    <div class="mx-auto p-4 form-container">
        <div class="text-center pb-4">
            <p class="h5">All Administrators</p>
        </div>
        <?php if (isset($_SESSION['success_message'])) : ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success_message') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['error_message'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error_message') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID #</td>
                <td>Name</td>
                <td>Email</td>
                <td>Position</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($admins as $admin) : ?>
            <tr>
                <td><?= $admin['admin_id'] ?></td>
                <td><?= $admin['first_name'] .' ' . $admin['last_name'] ?></td>
                <td><?= $admin['email'] ?></td>
                <td><?= $admin['position'] ?></td>
                <td><a href="#">View</a> | <a href="#">Edit</a> | <a href="#">Delete</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= script_tag('assets/modules/jquery.min.js') ?>
<?= script_tag('assets/modules/popper.js') ?>
<?= script_tag('assets/modules/tooltip.js') ?>
<?= script_tag('assets/modules/bootstrap/js/bootstrap.min.js') ?>

</body>
</html>