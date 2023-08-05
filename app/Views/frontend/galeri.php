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
                <li>Galeri</li>
            </ol>
            <h2>Galeri</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>GALERI</h2>
                <p></p>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($datagaleri as $d) : ?>
                    <div class="col-lg-4 col-md-6 portfolio-item">
                        <div class="portfolio-wrap">
                            <img src="<?= base_url('img/galeri') ?>/<?= $d->kategori_gambar ?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4><?= $d->kategori_judul ?></h4>
                                <div class="portfolio-links">
                                    <a href="<?= base_url('img/galeri') ?>/<?= $d->kategori_gambar ?>" data-gall="portfolioGallery" class="venobox" title="<?= $d->kategori_judul ?>"><i class="bx bx-plus"></i></a>
                                    <a href="<?= base_url() ?>/galeri/<?= $d->kategori_slug ?>" title="Selengkapnya"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>