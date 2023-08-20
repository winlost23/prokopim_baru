<?php

use App\Controllers\Nimda\Kontak;
?>
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

                    <!-- forum box -->
                    <div class="forum-box">
                        <div class="title-section">
                            <h1><span>Pidato</span></h1>
                        </div>
                        <h1><?= $konten->pidato_detail_judul ?></h1>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="20%">Kategori</td>
                                    <td width="80%"><?= $konten->kategori_judul ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Acara</td>
                                    <td><?= format_indo($konten->pidato_detail_tgl_acara) ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat</td>
                                    <td><?= $konten->pidato_detail_tempat ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pantun</td>
                                    <td><?= $jml_pantun ?></td>
                                </tr>
                                <tr>
                                    <td>File Pidato</td>
                                    <td><a href="<?= base_url('pidato/get_download/' . $konten->pidato_detail_id) ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                            <?= $konten->pidato_detail_judul . '.' .  $konten->pidato_detail_ext ?></a></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- End forum box -->

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