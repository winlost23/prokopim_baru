<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ADMIN PROKOPIM - <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_favicon ?>">
    <?= $this->renderSection('css') ?>

    <!-- App css -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Top Bar Start -->
    <?= $this->include('backend/master/topbar') ?>
    <!-- Top Bar End -->

    <!-- Left Sidenav -->
    <?= $this->include('backend/master/menu') ?>
    <!-- end left-sidenav-->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <?= $this->renderSection('content') ?>
            <?= $this->include('backend/master/footer') ?>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- jQuery  -->
    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/metismenu.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>/assets/js/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-ui.min.js"></script>

    <?= $this->renderSection('js') ?>

    <!-- App js -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>