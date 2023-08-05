<!doctype html>
<html lang="en" class="no-js">

<head>
  <title>Prokopim <?= $title ?></title>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Favicons -->
  <link href="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_favicon ?>" rel="icon">

  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic' rel='stylesheet' type='text/css'>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <?= $this->renderSection('css') ?>
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/jquery.bxslider.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/font-awesome.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/magnific-popup.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/owl.carousel.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/owl.theme.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/ticker-style.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('front') ?>/css/style.css" media="screen">
  <style>
    .navbar-nav>.menu_non>a:after {
      content: '';
      position: absolute;
      font-family: 'FontAwesome';
      font-size: 13px;
      color: #666666;
      top: 21px;
      right: 13px;
      transition: all 0.2s ease-in-out;
      -moz-transition: all 0.2s ease-in-out;
      -webkit-transition: all 0.2s ease-in-out;
      -o-transition: all 0.2s ease-in-out;
    }
  </style>
</head>

<body class="boxed">

  <!-- Container -->
  <div id="container">

    <!-- ======= Header ======= -->
    <?= $this->include('frontend/master/header') ?>
    <!-- End Header -->

    <!-- #main -->
    <?= $this->renderSection('content') ?>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?= $this->include('frontend/master/footer') ?>
    <!-- End Footer -->

  </div>
  <!-- End Container -->
  <?= $this->renderSection('js') ?>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.migrate.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.bxslider.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.magnific-popup.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.ticker.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.imagesloaded.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/retina-1.1.0.min.js"></script>
  <script type="text/javascript" src="<?= base_url('front') ?>/js/script.js"></script>

</body>

</html>