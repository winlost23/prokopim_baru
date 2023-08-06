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
                        <div class="search-box">
                            <form role="search" class="search-form" action="<?= base_url('pidato/cari') ?>" method="post">
                                <input type="text" style="width: 30%;" name="pidato_detail_judul" placeholder="Judul Pidato">
                                <input type="text" style="width: 30%;" name="pidato_detail_tempat" placeholder="Tempat">
                                <select name="kategori_id" style="width: 30%; border: 1px solid #eeeeee; padding: 10px; font-size: 11px; background-color: white; font-family: 'Lato', sans-serif; color: #999999; text-transform: uppercase;">
                                    <option value="0">Pilih Kategori</option>
                                    <?php foreach ($kategori as $d) : ?>
                                        <option value="<?= $d->kategori_id ?>"><?= $d->kategori_judul ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" id="search-submit2"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($konten)) : ?>
                                    <?php
                                    $no = 1;
                                    foreach ($konten as $d) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <span class="badge badge-pill rounded" style="background-color: #17a2b8; color: #fff;"><?= $d->kategori_judul ?></span> | <span class="badge badge-pill rounded" style="background-color: #dc3545; color: #fff;"><?= $d->pidato_detail_tgl_acara ?></span>
                                                <p><?= $d->pidato_detail_judul ?></p>
                                                <a href="<?= base_url('pidato/get_download/' . $d->pidato_detail_id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                <a href="<?= base_url('pidato/detail/' . $d->kategori_slug . '/' . $d->pidato_detail_slug) ?>" class="btn btn-primary btn-sm"><i class="fa fa-book" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" align="center">
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