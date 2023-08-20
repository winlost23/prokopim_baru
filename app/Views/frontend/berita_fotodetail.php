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
                            <h1><?= $konten->berita_foto_judul ?></h1>
                            <ul class="post-tags">
                                <?php
                                $date = strtotime($konten->created_at);
                                $newDate = date('d/M/Y h:i:s', $date);
                                ?>
                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                            </ul>
                        </div>

                        <div class="post-gallery">
                            <img src="<?= base_url('img/berita/' . $konten->berita_foto_gambar) ?>" alt="">
                            <!-- <span class="image-caption">Cras eget sem nec dui volutpat ultrices.</span> -->
                        </div>

                        <div class="post-content">

                            <?= $konten->berita_foto_deskripsi ?>
                        </div>


                        <!-- carousel box -->
                        <div class="carousel-box owl-wrapper">
                            <div class="title-section">
                                <h1><span>Berita Foto Lainya</span></h1>
                            </div>
                            <div class="owl-carousel" data-num="3">
                                <?php foreach ($lainya as $d) : ?>
                                    <div class="item news-post image-post3">
                                        <img src="<?= base_url('img/berita/' . $d->berita_foto_gambar) ?>" alt="">
                                        <div class="hover-box">
                                            <h2><a href="<?= base_url('berita_foto/detail/' . $d->berita_foto_slug) ?>"><?= $d->berita_foto_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d/M/Y h:i:s', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                        <!-- End carousel box -->

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