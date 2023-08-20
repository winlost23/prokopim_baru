<?= $this->extend('frontend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- block-wrapper-section
================================================== -->
<section class="block-wrapper left-sidebar">
    <div class="container">
        <!-- block content -->
        <div class="block-content non-sidebar">

            <!-- grid box -->
            <div class="grid-box">
                <div class="title-section">
                    <h1><span class="world">Berita Foto</span></h1>
                </div>

                <div class="row">
                    <?php foreach ($konten as $d) : ?>
                        <div class="col-md-4">
                            <div class="news-post standard-post2">
                                <div class="post-gallery">
                                    <img src="<?= base_url('img/berita/' . $d->berita_foto_gambar) ?>" alt="">
                                </div>
                                <div class="post-title">
                                    <h2><a href="<?= base_url('berita_foto/detail/' . $d->berita_foto_slug) ?>"><?= $d->berita_foto_slug ?></a></h2>
                                    <ul class="post-tags">
                                        <li><i class="fa fa-clock-o"></i><?= $d->created_at ?></li>
                                    </ul>
                                </div>
                                <div class="post-content">

                                    <a href="<?= base_url('berita_foto/detail/' . $d->berita_foto_slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End grid box -->

            <!-- pagination box -->
            <?= $pager->links('hal', 'paging') ?>
            <!-- End Pagination box -->

        </div>
        <!-- End block content -->

    </div>
</section>

<?= $this->endSection() ?>