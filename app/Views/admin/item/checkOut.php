<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Check Out Item</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Check out an item</h4>
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
                        <div>
                            <p class="m-0"><strong>Description</strong></p>
                            <p class="ml-2"><?= $item['item_description'] ?></p>
                        </div>
                        <div>
                            <p class="m-0"><strong>Quantity</strong></p>
                            <p class="ml-2"><?= $item['quantity'] ?>&nbsp;<?= $formattedUoM; ?>
                            </p>
                        </div>
                        <div>
                            <form action="<?= base_url("admin/item/updateCheckOut/{$item['item_id']}") ?>" method="post">
                                <div class="form-group">
                                    <label for="checkout_qty" class="d-block">Check Out Quantity</label>
                                    <input type="number" class="form-control w-25 d-inline" name="checkout_qty" id="checkout_qty"
                                           tabindex="1"
                                           min="1">
                                    <span class="ml-1"><?= $formattedUoM; ?></span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" tabindex="2">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>
