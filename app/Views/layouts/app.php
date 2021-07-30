<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Management System &mdash; <?php echo $page_title ?? 'Home'; ?></title>
    <!-- General CSS   -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>/assets/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/summernote/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/components.css">
</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <?= $this->include('layouts/header'); ?>
            <?= $this->include('layouts/sidebar'); ?>

            <?php $this->renderSection('content'); ?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y'); ?>
                    <div class="bullet"></div>
                    Created By <a href="http://bitrevlabs.co.ke">BitRev Labs</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>/assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/stisla.js"></script>

<!-- JS Libraries -->
<script src="<?php echo base_url(); ?>/assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/chart.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?php echo base_url(); ?>/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Page Specific JS -->
<?= script_tag('assets/js/page/index-0.js'); ?>

<!-- Template JS File -->
<script src="<?php echo base_url(); ?>/assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
</body>
</html>
