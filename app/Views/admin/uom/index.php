<?php $this->extend('admin/layouts/app'); ?>

<?php $this->section('content'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Unit of Measurement</h1>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of UoMs</h4>
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
                                        <td>UoM(Full)</td>
                                        <td>UoM(Short)</td>
                                        <td>Action</td>
                                    </tr>
                                    <?php foreach ($uoms as $uom) : ?>
                                        <tr>
                                            <td><?= $uom['uom_id'] ?></td>
                                            <td><?= $uom['uom_full'] ?></td>
                                            <td><?= $uom['uom_short'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/uom/show/' . $uom['uom_id']) ?>"
                                                   title="View"><i class="fas fa-eye">&nbsp;</i></a>
                                                <a href="<?= base_url('admin/uom/edit/' . $uom['uom_id']) ?>"
                                                   title="Edit"><i class="fas fa-pencil-alt text-warning">&nbsp;</i></a>
                                                <!--                                                <a href="#" onclick="" title="Delete"><i class="fas fa-trash text-danger"></i></a>-->
                                                <form onsubmit="return confirm('Are you sure?');" class="d-inline" id="frmDeleteUom" action="<?= base_url("admin/uom/delete/{$uom['uom_id']}") ?>"
                                                      method="post">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-link m-0 p-0" title="Delete"><i class="fas fa-trash text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php $this->endSection(); ?>