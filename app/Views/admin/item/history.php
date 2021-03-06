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
                                <table class="table table-bordered table-md" id="itemsTable">
                                    <thead>
                                    <tr>
                                        <th>ID #</th>
                                        <th>Name</th>
                                        <th>Checked In</th>
                                        <th>Checked Out</th>
                                        <th>Checked By</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $item['item_history_id'] ?></td>
                                            <td><?= $item['item_name'] ?></td>
                                            <td><?= $item['check_in'] ?>&nbsp;
                                                <?= uom_formatter($item['item_name'], $item['check_in'], $item['uom_full']) ?>
                                            </td>
                                            <td><?= $item['check_out'] ?>&nbsp;
                                                <?= uom_formatter($item['item_name'], $item['check_out'], $item['uom_full']) ?>
                                            </td>
                                            <td><?= $item['first_name'] . ' ' . $item['last_name'] ?></td>
                                            <td><?= date("M d, y h:i a", strtotime($item['created_at'])) ?></td>
                                            <td>
                                                <a href="#"
                                                   title="Undo"><i class="fas fa-undo">&nbsp;</i></a>
                                                <a href="#"
                                                   title="Redo"><i class="fas fa-redo">&nbsp;</i></a>
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