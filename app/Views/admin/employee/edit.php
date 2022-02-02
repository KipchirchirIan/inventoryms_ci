<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Employee</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update account of employee</h4>
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

                        <form action="<?= base_url("admin/employee/update/{$employee['emp_id']}") ?>" method="post">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name"
                                       class="form-control <?= isset(session()->getFlashdata('validation')['first_name']) ? 'is-invalid' : '' ?>"
                                       id="first_name" value="<?= old('first_name') ?? $employee['first_name'] ?>"
                                       tabindex="1">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['first_name'] ?? '' ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name"
                                       class="form-control <?= isset(session()->getFlashdata('validation')['last_name']) ? 'is-invalid' : ''; ?> ?>"
                                       id="last_name" value="<?= old('last_name') ?? $employee['last_name'] ?>"
                                       tabindex="2">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['last_name'] ?? '' ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" name="position"
                                       class="form-control <?= isset(session()->getFlashdata('validation')['position']) ? 'is-invalid' : ''; ?> ?>"
                                       id="position" value="<?= old('position') ?? $employee['position'] ?>"
                                       tabindex="3">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['position'] ?? '' ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email"
                                       class="form-control-plaintext"
                                       id="email" value="<?= old('email') ?? $employee['email'] ?>" tabindex="4" readonly>
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
