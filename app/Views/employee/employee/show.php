<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Employee</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $employee['first_name'] . ' ' . $employee['last_name'] ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->has('success_message')) : ?>
                            <div class="alert alert-success alert-dismissible show fade w-50">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= session()->get('success_message') ?>
                                </div>
                            </div>
                        <?php elseif (session()->has('error_message')) : ?>
                            <div class="alert alert-danger alert-dismissible show fade w-50">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= session()->get('error_message') ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <img class="img-fluid" style="width: 150px;"
                                 src="<?= base_url('assets/img/avatar/avatar-1.png') ?>" alt="Default Avatar">
                            <div class="d-inline ml-2">
                                <p class="m-0">
                                    <strong>Name:</strong>&nbsp;<?= $employee['first_name'] . ' ' . $employee['last_name'] ?>
                                    <?= ($employee['email'] === session()->get('ims_email')) ? '<strong>(You)</strong>' : '' ?>
                                </p>
                                <p class="m-0"><strong>Position:</strong>&nbsp;
                                    <?= !empty($employee['position']) ? $employee['position'] : '&#8211;' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php $this->endSection(); ?>
