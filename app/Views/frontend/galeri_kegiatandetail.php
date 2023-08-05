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
                            <h1><?= $slug->galeri_kegiatan_judul ?></h1>
                            <ul class="post-tags">
                                <?php
                                $date = strtotime($slug->created_at);
                                $newDate = date('d/M/Y h:i:s', $date);
                                ?>
                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                            </ul>
                        </div>
                        <div class="article-inpost">
                            <div class="row">
                                <?php
                                foreach ($konten as $d) : ?>
                                    <div class="col-md-6">
                                        <div class="image-content">
                                            <div class="image-place">
                                                <img src="<?= base_url('img/galeri/' . $d->galeri_kegiatan_foto_file) ?>" alt="">
                                                <div class="hover-image">
                                                    <a class="zoom" href="<?= base_url('img/galeri/' . $d->galeri_kegiatan_foto_file) ?>"><i class="fa fa-arrows-alt"></i></a>
                                                </div>
                                            </div>
                                            <!-- <span class="image-caption">Cras eget sem nec dui volutpat ultrices.</span> -->
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- carousel box -->
                        <div class="carousel-box owl-wrapper">
                            <div class="title-section">
                                <h1><span>Galeri Kegiatan Lainya</span></h1>
                            </div>
                            <div class="owl-carousel" data-num="3">
                                <?php

                                use App\Models\GaleriKegiatanFotoModel;

                                $this->galeriKegiatanFotoModel = new GaleriKegiatanFotoModel();
                                foreach ($lainya as $d) :
                                    $gambar = $this->galeriKegiatanFotoModel
                                        ->where('galeri_kegiatan_id', $d->galeri_kegiatan_id)
                                        ->first(); ?>
                                    <div class="item news-post image-post3">
                                        <img src="<?= base_url('img/galeri/' . $gambar->galeri_kegiatan_foto_file) ?>" alt="">
                                        <div class="hover-box">
                                            <h2><a href="<?= base_url('galeri_kegiatan/detail/' . $d->galeri_kegiatan_slug) ?>"><?= $d->galeri_kegiatan_judul ?></a></h2>
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