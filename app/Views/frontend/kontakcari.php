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
                    <div class="row">
                        <div class="sidebar">
                            <div class="col-sm-6">
                                <div class="widget subscribe-widget">
                                    <form class="subscribe-form" action="<?= base_url('kontak/cari') ?>" method="post">
                                        <h1>Pencarian Surat Warga</h1>
                                        <input type="text" name="kontak_nama" placeholder="Nama Warga" />
                                        <button type="submit">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </button>
                                        <p>Get all latest content delivered to your email a few times a month.</p>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="widget subscribe-widget">
                                    <form class="subscribe-form">
                                        <h1>Isi Form Kontak</h1>
                                        <a href="<?= base_url('kontak/form') ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i> Isi Form Kontak</a>

                                        <p>Silahkan mengisi fasilitas komunikasi <b>Kontak Kami</b>. Mohon masukan dan pertanyaan disampaikan secara bijak dengan kata-kata yang baik. </p>
                                        <p>Seluruh komentar yang masuk akan kami moderasi terlebih dahulu sebelum ditampilkan. Komentar yang mengandung unsur sara, <i>hoax</i>, pornografi, spam, ujaran kebencian, atau link tidak bermanfaat akan kami hapus.</p>
                                        <p>Untuk pertanyaan, keluhan, masukan atau saran, silahkan disampaikan/ditulis dengan cara mengklik <b>Isi Form Kontak</b> diatas. Terimakasih.</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- single-post box -->
                    <div class="single-post-box">

                        <!-- comment area box -->
                        <div class="comment-area-box">
                            <div class="title-section">
                                <h1><span>Kontak Kami</span></h1>
                            </div>
                            <ul class="comment-tree">
                                <?php

                                use App\Models\KontakModel;

                                if (!empty($konten)) : ?>
                                    <?php



                                    $this->kontakModel = new KontakModel();
                                    foreach ($konten as $d) :
                                        $balas = $this->kontakModel
                                            ->where('kontak_id_parent', $d->kontak_id)
                                            ->first(); ?>
                                        <li>
                                            <div class="comment-box">
                                                <img alt="" src="<?= base_url('img/img_avatar3.png') ?>">
                                                <div class="comment-content">
                                                    <h4><?= $d->kontak_nama ?></h4>
                                                    <h5><?= $d->kontak_pekerjaan ?></h5>
                                                    <span><i class="fa fa-clock-o"></i><?= $d->created_at ?></span>
                                                    <?= $d->kontak_komentar ?>
                                                </div>
                                            </div>
                                            <?php if ($balas) { ?>
                                                <ul class="depth">
                                                    <li>
                                                        <div class="comment-box">
                                                            <img alt="" src="<?= base_url('img/welcome.png') ?>">
                                                            <div class="comment-content">
                                                                <h4>Admin</h4>
                                                                <span><i class="fa fa-clock-o"></i><?= $balas->created_at ?></span>
                                                                <?= $balas->kontak_komentar ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="col-md-12" style="text-align: center;">
                                        <p>Tidak ada hasil.</p>
                                    </div>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- End comment area box -->

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