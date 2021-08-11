<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?= link_tag('assets/modules/bootstrap/css/bootstrap.min.css'); ?>
    <?= link_tag('assets/modules/fontawesome/css/all.min.css'); ?>

    <title>Super Admin | Login</title>
    <style>
        .form-container {
            width: 40% !important;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="<?= base_url('superadmin'); ?>">IMS</a>
</nav>

<div class="container">

    <div class="container text-center pt-3">
        <h2>Hello, <?= session()->get('ims_name') ?></h2>
        <p><a href="<?= base_url('superadmin/logout'); ?>">Logout</a></p>
    </div>

    <div class="mx-auto card p-4 form-container">
        <div class="text-center pb-4">
            <p class="h5">Add Administrator</p>
        </div>
        <?php if (isset($_SESSION['success_message'])) : ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['error_message'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error_message'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form class="" method="post" action="<?= base_url('superadmin/admin/store') ?>">
            <?= csrf_field(); ?>
            <div class="row mb-n1">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo isset($admin['first_name']) ? $admin['first_name'] : ''; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo isset($admin['last_name']) ? $admin['last_name'] : ''; ?>">
                    </div>
                </div>
            </div>
            <?php if (isset($validation)): ?>
                <?php if ($validation->hasError('first_name')): ?>
                    <small class="text-danger"><?php echo $validation->getError('first_name'); ?></small>
                <?php elseif ($validation->hasError('last_name')): ?>
                    <small class="text-danger"><?php echo $validation->getError('last_name'); ?></small>
                <?php endif; ?>
            <?php endif; ?>
            <div class="form-group">
                <label class="sr-only" for="position">Position</label>
                <input type="text" class="form-control" name="position" id="position" placeholder="Position" value="<?php echo isset($admin['position']) ? $admin['position'] : ''; ?>">
                <?php if (isset($validation) && $validation->hasError('position')): ?>
                    <small class="text-danger"><?php echo $validation->getError('position'); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="sr-only" for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo isset($admin['email']) ? $admin['email'] : ''; ?>" aria-describedby="emailHelp">
                <?php if (isset($validation) && $validation->hasError('email')): ?>
                    <small class="text-danger"><?php echo $validation->getError('email'); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="sr-only" for="password">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" id="password">
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                    <small class="text-danger"><?php echo $validation->getError('password'); ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>

<?= script_tag('assets/modules/jquery.min.js'); ?>
<?= script_tag('assets/modules/popper.js'); ?>
<?= script_tag('assets/modules/tooltip.js'); ?>
<?= script_tag('assets/modules/bootstrap/js/bootstrap.min.js'); ?>

</body>
</html>