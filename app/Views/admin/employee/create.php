<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add Employee</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Create an account for an employee</h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->has('success_message')) : ?>
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= session()->get('success_message') ?>
                                </div>
                            </div>
                        <?php elseif (session()->has('error_message')) : ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= session()->get('error_message') ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('admin/employee/create') ?>" method="post">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name"
                                       class="form-control <?= (isset($validation) && $validation->hasError('first_name')) ? 'is-invalid' : ''; ?> ?>"
                                       id="first_name" value="<?= $employee['first_name'] ?? '' ?>" tabindex="1">
                                <?php if (isset($validation) && $validation->hasError('first_name')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('first_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name"
                                       class="form-control <?= (isset($validation) && $validation->hasError('last_name')) ? 'is-invalid' : ''; ?> ?>"
                                       id="last_name" value="<?= $employee['last_name'] ?? '' ?>" tabindex="2">
                                <?php if (isset($validation) && $validation->hasError('last_name')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('last_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" name="position"
                                       class="form-control <?= (isset($validation) && $validation->hasError('position')) ? 'is-invalid' : ''; ?> ?>"
                                       id="position" value="<?= $employee['position'] ?? '' ?>" tabindex="3">
                                <?php if (isset($validation) && $validation->hasError('position')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('position') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email"
                                       class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : ''; ?> ?>"
                                       id="email" value="<?= $employee['email'] ?? '' ?>" tabindex="4">
                                <?php if (isset($validation) && $validation->hasError('email')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                       class="form-control <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : ''; ?> ?>"
                                       id="password" tabindex="5">
                                <?php if (isset($validation) && $validation->hasError('password')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" tabindex="6">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>
