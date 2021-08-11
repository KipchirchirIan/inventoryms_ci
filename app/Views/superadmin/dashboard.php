<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?= link_tag('assets/modules/bootstrap/css/bootstrap.min.css'); ?>
    <?= link_tag('assets/modules/fontawesome/css/all.min.css'); ?>

    <title>Super Admin | Home</title>
    <style>
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="<?= base_url('superadmin'); ?>">IMS</a>
</nav>

<div class="container text-center pt-3">
    <h2>Welcome, <?= session()->get('ims_name') ?></h2>
    <p><a href="<?= base_url('superadmin/logout'); ?>">Logout</a></p>

    <div class="">
        <a href="<?= base_url('superadmin/admin/create'); ?>" role="button" class="btn btn-primary">Create Admin</a>
        <a href="<?= base_url('superadmin/admin/index'); ?>" role="button" class="btn btn-primary">View Admins</a>
    </div>
</div>

<!-- Bootstrap JS-->
<?= script_tag('assets/modules/jquery.min.js'); ?>
<?= script_tag('assets/modules/popper.js'); ?>
<?= script_tag('assets/modules/tooltip.js'); ?>
<?= script_tag('assets/modules/bootstrap/js/bootstrap.min.js'); ?>

</body>
</html>