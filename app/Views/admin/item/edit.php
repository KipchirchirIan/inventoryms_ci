<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Update Item</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update <?= $item['item_name'] ?></h4>
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
                            <form action="<?= base_url("admin/item/update/{$item['item_id']}") ?>" method="post">
                                <div class="form-group">
                                    <label for="item_name">Item Name</label>
                                    <input type="text" name="item_name"
                                           class="form-control <?= isset(session()->getFlashdata('validation')['item_name']) ? 'is-invalid' : '' ?>"
                                           id="item_name" value="<?=  old('item_name') ?? $item['item_name'] ?>"
                                           tabindex="1">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['item_name'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="item_description">Item Description</label>
                                    <textarea name="item_description"
                                              class="form-control <?= isset(session()->getFlashdata('validation')['item_description']) ? 'is-invalid' : '' ?>"
                                              id="item_description" cols="30"
                                              rows="10"><?= old('item_description') ?? $item['item_description'] ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['item_description'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">Item Category</label>
                                    <select class="form-control <?= isset(session()->getFlashdata('validation')['category']) ? 'is-invalid' : '' ?>"
                                            name="category" id="category">
                                        <option value="" disabled selected>--Select Category--</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['category_id'] ?>"<?= ($category['category_id'] === $item['category_id']) ? ' selected' : '' ?>>
                                                <?= ucfirst($category['category_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['category'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uom">Unit of Measurement</label>
                                    <select class="form-control <?= isset(session()->getFlashdata('validation')['uom']) ? 'is-invalid' : '' ?>"
                                            name="uom" id="uom">
                                        <option value="" disabled selected>--Select unit of measurement--
                                        </option>
                                        <?php foreach ($uoms as $uom) : ?>
                                            <option value="<?= $uom['uom_id'] ?>"<?= ($uom['uom_id'] === $item['uom']) ? ' selected' : '' ?>>
                                                <?= ucfirst($uom['uom_full']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('validation')['uom'] ?? '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note"
                                              class="form-control <?= isset(session()->getFlashdata('validation')['note']) ? 'is-invalid' : '' ?>"
                                              id="note" cols="30"
                                              rows="10"><?= old('note') ?? $item['note'] ?? '' ?></textarea>
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