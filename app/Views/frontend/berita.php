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
        <div class="row">

            <div class="col-sm-8">

                <!-- block content -->
                <div class="block-content">

                    <!-- article box -->
                    <div class="article-box">
                        <div class="title-section">
                            <h1><span class="world">Berita - <?= $slug->berita_judul ?></span></h1>
                        </div>

                        <?php foreach ($konten as $d) : ?>

                            <div class="news-post article-post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="post-gallery">
                                            <img alt="" src="<?= base_url('img/berita/' . $d->berita_detail_gambar) ?>">
                                            <a class="category-post world" href="<?= base_url('berita/detail/' . $slug->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $slug->berita_judul ?></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('berita/detail/' . $slug->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $d->berita_detail_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d/M/Y h:i:s', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                                <li><i class="fa fa-user"></i>Editor: <?= $d->berita_detail_editor ?></li>
                                                <li><i class="fa fa-eye"></i><?= $d->berita_detail_dibaca ?></li>
                                            </ul>
                                            <?php
                                            $kalimat = htmlentities(strip_tags($d->berita_detail_isi));
                                            $desc = substr($kalimat, 0, 100);
                                            $desc = substr($kalimat, 0, strrpos($desc, " "));
                                            ?>
                                            <?= $desc ?>
                                            <p></p>
                                            <a href="<?= base_url('berita/detail/' . $slug->berita_slug . '/' . $d->berita_detail_slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                    <!-- End article box -->

                    <!-- pagination box -->
                    <?= $pager->links('hal', 'paging') ?>
                    <!-- End Pagination box -->

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