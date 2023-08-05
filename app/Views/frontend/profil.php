<?= $this->extend('frontend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="block-wrapper left-sidebar">
    <div class="container">
        <div class="row">

            <div class="col-sm-8">

                <!-- block content -->
                <div class="block-content">

                    <!-- single-post box -->
                    <div class="single-post-box">

                        <div class="title-post">
                            <h1><?= $konten->profil_judul ?></h1>
                        </div>

                        <div class="post-content">

                            <?= $konten->profil_isi ?>
                        </div>

                        <div class="share-post-box">
                            <ul class="share-box">
                                <li><i class="fa fa-share-alt"></i><span>Share Post</span></li>
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i>Share on Facebook</a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i>Share on Twitter</a></li>
                                <li><a class="google" href="#"><i class="fa fa-google-plus"></i><span></span></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i><span></span></a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- End single-post box -->

                </div>
                <!-- End block content -->

            </div>

            <div class="col-sm-4">

                <?= $this->include('frontend/master/side') ?>

            </div>

        </div>

    </div>
</section>
<?= $this->endSection() ?>