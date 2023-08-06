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
                            <h1><span>Download</span></h1>
                        </div>
                        <div class="search-box">
                            <form role="search" class="search-form" method="post" action="<?= base_url('download/cari') ?>">
                                <input type="text" id="search2" name="download_detail_judul" placeholder="Nama">
                                <button type="submit" id="search-submit2"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Ukuran</th>
                                    <th>Tanggal</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($konten)) : ?>
                                    <?php
                                    $nomor = 1;
                                    foreach ($konten as $d) : ?>
                                        <tr>
                                            <td><?= $nomor++ ?></td>
                                            <td><?= $d->download_detail_judul ?></td>
                                            <td><?= $d->download_detail_ukuran ?> Kb</td>
                                            <td><?= $d->created_at ?></td>
                                            <td>
                                                <a href="<?= base_url('download/get_download/' . $d->download_detail_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" align="center">
                                            <p>Tidak ada hasil.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
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