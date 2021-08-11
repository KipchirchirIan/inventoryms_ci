<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Items</h1>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Check In/Out Items</h4>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-md" id="itemsTable">
                                    <thead>
                                    <tr>
                                        <td>ID #</td>
                                        <td>Name</td>
                                        <td>Description</td>
                                        <td>Quantity</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $item['item_id'] ?></td>
                                            <td><?= $item['item_name'] ?></td>
                                            <td><?= $item['item_description'] ?></td>
                                            <td><?= $item['quantity'] ?>
                                                <?php
                                                if ($item['quantity'] > 1) {
                                                    if (strtolower($item['uom_full']) === 'none') {
                                                        echo ucwords($inflector->pluralize($item['item_name']));
                                                    } else {
                                                        echo ucwords($inflector->pluralize($item['uom_full']));
                                                    }
                                                } else {
                                                    echo ucwords($item['uom_full']);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('employee/item/checkIn/' . $item['item_id']) ?>"
                                                   title="Check In"><i class="fas fa-caret-up">&nbsp;</i></a>
                                                <a href="<?= base_url('employee/item/checkOut/' . $item['item_id']) ?>"
                                                   title="Check Out"><i class="fas fa-caret-down">&nbsp;</i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (count($items) < 1) : ?>
                                            <tr>
                                                <td colspan="8" class="text-center"><strong>0 records found</strong></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php $this->endSection(); ?>