<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Change Password</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Change your password</h4>
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
                            <form action="<?= route_to('Admin\Profile::attemptChangePassword') ?>" method="post">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" name="old_password"
                                           class="form-control<?= isset(session()->getFlashdata('validation')['old_password']) ? ' is-invalid' : '' ?>"
                                           id="old_password" value="<?= old('old_password') ?? '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['old_password'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password"
                                           class="form-control<?= isset(session()->getFlashdata('validation')['new_password']) ? ' is-invalid' : '' ?>"
                                           id="new_password" value="<?= old('new_password') ?? '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['new_password'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password"
                                           class="form-control<?= isset(session()->getFlashdata('validation')['confirm_password']) ? ' is-invalid' : '' ?>"
                                           id="confirm_password" value="<?= old('confirm_password') ?? '' ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['confirm_password'] ?? '' ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
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