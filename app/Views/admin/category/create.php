<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add Category</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Create a category</h4>
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
                        <form action="<?= base_url('admin/category/store') ?>" method="post">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" name="category_name"
                                       class="form-control <?= isset(session()->getFlashdata('validation')['category_name']) ? 'is-invalid' : '' ?>"
                                       id="category_name" value="<?= old('category_name') ?? '' ?>" tabindex="1">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['category_name'] ?? '' ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_description">Category Description</label>
                                <textarea name="category_description"
                                          class="form-control <?= isset(session()->getFlashdata('validation')['category_description']) ? 'is-invalid' : '' ?>"
                                          id="category_description" cols="30"
                                          rows="10"><?= old('category_description') ?? '' ?></textarea>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['category_description'] ?? '' ?>
                                </div>
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
