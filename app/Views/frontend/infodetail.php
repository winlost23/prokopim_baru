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
                <li><a href="<?= base_url() ?>/info/<?= $dinfo->kategori_slug ?>"><?= $dinfo->kategori_slug ?></a></li>
                <li><?= $datainfodetail->info_slug ?></li>
            </ol>
            <h2><?= $datainfodetail->info_judul ?></h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="<?= base_url() ?>/img/info/<?= $datainfodetail->info_gambar ?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <?= $datainfodetail->info_judul ?>
                        </h2>



                        <div class="entry-content">
                            <?= $datainfodetail->info_isi ?>
                            <br><br>
                            <?php
                            if ($datainfodetail->info_file != '') {
                            ?>
                                <h5>File</h5>
                                <a class="btn btn-danger" href="<?= base_url() ?>/info/download/<?= $datainfodetail->info_id ?>/<?= $dinfo->kategori_slug ?>/<?= $datainfodetail->info_slug ?>">Donwload File</a>
                                <br><br>
                                <?php if (session()->getFlashdata('tipe')) : ?>
                                    <div class="alert alert-<?= session()->getFlashdata('tipe') ?>" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php endif; ?>
                            <?php
                            } else {
                            ?>
                                <h5>Tidak Ada File</h5>
                            <?php
                            }
                            ?>

                            <br><br>
                        </div>

                        <div class="entry-footer clearfix">


                        </div>

                    </article><!-- End blog entry -->



                </div><!-- End blog entries list -->

                <div class="col-lg-4">
                    <?= $this->include('frontend/master/side') ?>
                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->
<?= $this->endSection() ?>