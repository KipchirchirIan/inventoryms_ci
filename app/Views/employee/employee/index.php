<?php $this->extend('layouts/app'); ?>

<?php $this->section('content'); ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Employees</h1>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of Employees</h4>
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
                                        <td>Email</td>
                                        <td>Position</td>
                                        <td>Action</td>
                                    </tr>
                                    <?php foreach ($employees as $employee) : ?>
                                        <tr>
                                            <td><?= $employee['emp_id'] ?></td>
                                            <td>
                                                <?= $employee['first_name'] . ' ' . $employee['last_name'] ?>
                                                <?php echo ($employee['email'] === session()->get('ims_email')) ? '<strong>(You)</strong>' : ''; ?>
                                            </td>
                                            <td><?= $employee['email'] ?></td>
                                            <td class="text-center"><?= (!empty($employee['position'])) ? $employee['position'] : '&#8211;' ?></td>
                                            <td>
                                                <a href="<?= base_url('employee/employee/show/' . $employee['emp_id']) ?>"
                                                   title="View"><i class="fas fa-eye">&nbsp;</i></a>
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