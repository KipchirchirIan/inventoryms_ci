<?php $this->extend('admin/layouts/app'); ?>

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
                            <h4>List of items</h4>
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
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <td>ID #</td>
                                        <td>Name</td>
                                        <td>Description</td>
                                        <td>Quantity</td>
                                        <td>Action</td>
                                    </tr>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $item['item_id'] ?></td>
                                            <td><?= $item['item_name'] ?></td>
                                            <td><?= $item['item_description'] ?></td>
                                            <td><?= $item['quantity'] ?>&nbsp;<?php
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
                                                <a href="<?= base_url('admin/item/show/' . $item['item_id']) ?>"
                                                   title="View"><i class="fas fa-eye">&nbsp;</i></a>
                                                <a href="<?= base_url('admin/item/edit/' . $item['item_id']) ?>"
                                                   title="Edit"><i class="fas fa-pencil-alt text-warning">&nbsp;</i></a>
                                                <!--                                                <a href="#" onclick="" title="Delete"><i class="fas fa-trash text-danger"></i></a>-->
                                                <form onsubmit="return confirm('Are you sure?');" class="d-inline"
                                                      id="frmDeleteItem"
                                                      action="<?= base_url("admin/item/delete/{$item['item_id']}") ?>"
                                                      method="post">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-link m-0 p-0" title="Delete"><i
                                                                class="fas fa-trash text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (count($items) < 1) : ?>
                                        <tr>
                                            <td colspan="8" class="text-center"><strong>0 records found</strong></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php $this->endSection(); ?>