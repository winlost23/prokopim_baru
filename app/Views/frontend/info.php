<?= $this->extend('frontend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url() ?>/home">Home</a></li>
                <li>Info</li>
                <li><?= $dinfo->kategori_slug ?></li>
            </ol>
            <h2><?= $dinfo->kategori_judul ?></h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <?php foreach ($datainfo as $d) : ?>
                        <article class="entry">

                            <div class="entry-img">
                                <img src="<?= base_url() ?>/img/info/<?= $d->info_gambar ?>" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="<?= base_url() ?>/info/<?= $dinfo->kategori_slug ?>/<?= $d->info_slug ?>"><?= $d->info_judul ?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="#"><?= $d->users_name ?></a></li>
                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="#"><time datetime="<?= $d->created_at ?>"><?= $d->created_at ?></time></a></li>
                                    <li class="d-flex align-items-center"><i class="icofont-folder"></i> <a href="#"><?= $dinfo->kategori_slug ?></a></li>

                                </ul>
                            </div>

                            <div class="entry-content">
                                <?php
                                $isi_berita = htmlentities(strip_tags($d->info_isi));
                                $isi = substr($isi_berita, 0, 100);
                                $isi = substr($isi_berita, 0, strrpos($isi, " "));
                                ?>
                                <?= $isi ?>
                                <div class="read-more">
                                    <a href="<?= base_url() ?>/info/<?= $dinfo->kategori_slug ?>/<?= $d->info_slug ?>">Selengkapnya</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->
                    <?php endforeach; ?>



                </div><!-- End blog entries list -->

                <div class="col-lg-4">
                    <?= $this->include('frontend/master/side') ?>
                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>