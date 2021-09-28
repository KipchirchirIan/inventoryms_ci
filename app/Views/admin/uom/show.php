<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>View Unit of Measurement</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4><?= ucwords($uom['uom_full']) ?></h4>
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
                        <div class="">
                            <p class="m-0"><strong>Full Name</strong></p>
                            <p class="ml-2"><?= ucwords($uom['uom_full']) ?></p>
                        </div>
                        <div class="">
                            <p class="m-0"><strong>Short Name</strong></p>
                            <p class="ml-2"><?= $uom['uom_short'] ?></p>
                        </div>
                        <div>
                            <p class="m-0"><strong>Description</strong></p>
                            <p class="ml-2"><?= $uom['uom_description'] ?></p>
                        </div>
                        <div>
                            <a class="btn btn-primary" role="button" aria-pressed="true"
                               href="<?= base_url('admin/uom/edit/' . $uom['uom_id']) ?>">Edit</a>
                            <form onsubmit="return confirm('Are you sure?');" class="d-inline"
                                  id="frmDeleteCategory"
                                  action="<?= base_url("admin/uom/delete/{$uom['uom_id']}") ?>"
                                  method="post">
                                <?= csrf_field() ?>
                                <button class="btn btn-danger" title="Delete">Delete</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>
