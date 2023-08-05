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
                    <h1><span class="world">Galeri Kegiatan</span></h1>
                </div>

                <div class="row">
                    <?php

                    use App\Models\GaleriKegiatanFotoModel;

                    $this->galeriKegiatanFotoModel = new GaleriKegiatanFotoModel();
                    foreach ($konten as $d) :
                        $gambar = $this->galeriKegiatanFotoModel
                            ->where('galeri_kegiatan_id', $d->galeri_kegiatan_id)
                            ->first();
                    ?>
                        <div class="col-md-4">
                            <div class="news-post standard-post2">
                                <div class="post-gallery">
                                    <img src="<?= base_url('img/galeri/' . $gambar->galeri_kegiatan_foto_file) ?>" alt="">
                                </div>
                                <div class="post-title">
                                    <h2><a href="<?= base_url('galeri_kegiatan/detail/' . $d->galeri_kegiatan_slug) ?>"><?= $d->galeri_kegiatan_judul ?></a></h2>
                                    <ul class="post-tags">
                                        <li><i class="fa fa-clock-o"></i><?= $d->created_at ?></li>
                                    </ul>
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