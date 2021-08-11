<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Unit of Measurement</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update a unit of measurement</h4>
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

                        <form action="<?= base_url("admin/uom/update/{$uom['uom_id']}") ?>" method="post">
                            <div class="form-group">
                                <label for="uom_full">UoM - Full&nbsp;<i class="far fa-question-circle"
                                                                         data-toggle="tooltip" data-placement="top"
                                                                         title="Unit of Measurement in full e.g. Kilogram"></i></label>
                                <input type="text" name="uom_full"
                                       class="form-control <?= isset(session()->getFlashdata('validation')['uom_full']) ? 'is-invalid' : ''; ?> ?>"
                                       id="uom_full" value="<?= old('uom_full') ?? $uom['uom_full'] ?? '' ?>"
                                       tabindex="1">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['uom_full'] ?? '' ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="uom_short">UoM - Short&nbsp;<i class="far fa-question-circle"
                                                                           data-toggle="tooltip" data-placement="top"
                                                                           title="Unit of Measurement in short e.g. kg"></i></label>
                                <input type="text" name="uom_short"
                                       class="form-control <?= isset(session()->getFlashdata('validation')['uom_short']) ? 'is-invalid' : ''; ?> ?>"
                                       id="uom_short" value="<?= old('uom_short') ?? $uom['uom_short'] ?? '' ?>" tabindex="2">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('validation')['uom_short'] ?? '' ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="uom_description">UoM Description</label>
                                    <textarea name="uom_description" class="form-control" id="uom_description" cols="40"
                                              rows="10"><?= $uom['uom_description'] ?? '' ?></textarea>
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
