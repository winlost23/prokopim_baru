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
                            <h1><span>Agenda</span></h1>
                        </div>
                        <h1><?= $konten->agenda_judul ?></h1>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="20%">Tanggal</td>
                                    <td width="80%"><?= format_indo($konten->agenda_tanggal) ?></td>
                                </tr>
                                <tr>
                                    <td>Jam</td>
                                    <td><?= $konten->agenda_jam ?> WITA</td>
                                </tr>
                                <tr>
                                    <td>Agenda</td>
                                    <td><?= $konten->agenda_judul ?></td>
                                </tr>
                                <tr>
                                    <td>Lokasi</td>
                                    <td><?= $konten->agenda_lokasi ?></td>
                                </tr>
                                <tr>
                                    <td>Petugas</td>
                                    <td><?= $konten->agenda_petugas ?></td>
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