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
                    <h1><span class="world">Penghargaan</span></h1>
                </div>
                <div class="search-box">
                    <form role="search" class="search-form" action="<?= base_url('penghargaan/cari') ?>" method="post">
                        <input type="text" style="width: 30%;" name="penghargaan_judul" placeholder="Judul Penghargaan">
                        <select name="penghargaan_tahun" style="width: 30%; border: 1px solid #eeeeee; padding: 10px; font-size: 11px; background-color: white; font-family: 'Lato', sans-serif; color: #999999; text-transform: uppercase;">
                            <option value="0">Pilih Tahun</option>
                            <?php
                            $th = date('Y');
                            for ($i = $th; $i >= 2010; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <select name="kategori_id" style="width: 30%; border: 1px solid #eeeeee; padding: 10px; font-size: 11px; background-color: white; font-family: 'Lato', sans-serif; color: #999999; text-transform: uppercase;">
                            <option value="0">Pilih Kategori</option>
                            <?php foreach ($kategori as $d) : ?>
                                <option value="<?= $d->kategori_id ?>"><?= $d->kategori_judul ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" id="search-submit2"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="row">
                    <?php if (!empty($konten)) : ?>
                        <?php foreach ($konten as $d) : ?>
                            <div class="col-md-4">
                                <div class="news-post standard-post2">
                                    <div class="post-gallery">
                                        <img src="<?= base_url('img/berita/' . $d->penghargaan_gambar) ?>" alt="">
                                        <a class="category-post world" href="<?= base_url('penghargaan/detail/' . $d->kategori_slug . '/' . $d->penghargaan_slug) ?>"><?= $d->kategori_judul ?></a>
                                    </div>
                                    <div class="post-title">
                                        <h2><a href="<?= base_url('penghargaan/detail/' . $d->kategori_slug . '/' . $d->penghargaan_slug) ?>"><?= $d->penghargaan_judul ?></a></h2>
                                        <ul class="post-tags">
                                            <li><i class="fa fa-clock-o"></i><?= $d->penghargaan_tahun ?></li>
                                        </ul>
                                    </div>
                                    <div class="post-content">
                                        <?php
                                        $kalimat = htmlentities(strip_tags($d->penghargaan_isi));
                                        $desc = substr($kalimat, 0, 100);
                                        $desc = substr($kalimat, 0, strrpos($desc, " "));
                                        ?>
                                        <p><?= $desc ?></p>
                                        <a href="<?= base_url('penghargaan/detail/' . $d->kategori_slug . '/' . $d->penghargaan_slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-md-12" style="text-align: center;">
                            <p>Tidak ada hasil.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End grid box -->

            <!-- pagination box -->
            <!-- End Pagination box -->

        </div>
        <!-- End block content -->

    </div>
</section>

<?= $this->endSection() ?>