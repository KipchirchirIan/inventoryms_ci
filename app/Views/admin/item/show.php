<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>View Item</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $item['item_name'] ?></h4>
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
                            <p class="m-0"><strong>Name</strong></p>
                            <p class="ml-2"><?= $item['item_name'] ?></p>
                        </div>
                        <div class="">
                            <p class="m-0"><strong>Category</strong></p>
                            <p class="ml-2"><?= $item['category_name'] ?></p>
                        </div>
                        <div>
                            <p class="m-0"><strong>Description</strong></p>
                            <p class="ml-2"><?= $item['item_description'] ?></p>
                        </div>
                        <div>
                            <p class="m-0"><strong>Quantity</strong></p>
                            <p class="ml-2"><?= $item['quantity'] ?>
                                &nbsp;<?= uom_formatter($item['item_name'], $item['quantity'], $item['uom_full']) ?>
                            </p>
                        </div>
                        <div>
                            <a class="btn btn-primary" role="button" aria-pressed="true"
                               href="<?= base_url('admin/item/checkIn/' . $item['item_id']) ?>">Check In</a>
                            <a class="btn btn-primary" role="button" aria-pressed="true"
                               href="<?= base_url('admin/item/checkOut/' . $item['item_id']) ?>">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>
