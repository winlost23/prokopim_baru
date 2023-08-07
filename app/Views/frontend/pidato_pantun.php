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
                            <h1><span>Pantun Pidato</span></h1>
                        </div>
                        <div class="search-box">
                            <form role="search" class="search-form" action="<?= base_url('pantun_pidato/cari') ?>" method="post">
                                <input type="text" style="width: 30%;" name="pidato_detail_judul" placeholder="Judul Pidato">
                                <select name="kategori_id" style="width: 30%; border: 1px solid #eeeeee; padding: 10px; font-size: 11px; background-color: white; font-family: 'Lato', sans-serif; color: #999999; text-transform: uppercase;">
                                    <option value="0">Pilih Kategori</option>
                                    <?php

                                    use App\Models\PidatoPantunModel;

                                    foreach ($kategori as $d) : ?>
                                        <option value="<?= $d->kategori_id ?>"><?= $d->kategori_judul ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <a href="" style="border: 1px solid #007bff; text-decoration: none; color: white; background-color: #007bff; display: inline-block; padding: 5px 20px; font-family: 'Lato', sans-serif;">Statistik</a>
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
                                <?php
                                $this->pidatoPantunModel = new PidatoPantunModel();
                                $no = 1;
                                foreach ($konten as $d) :
                                    $data = $this->pidatoPantunModel
                                        ->join('pidato_detail', 'pidato_pantun.pidato_detail_id = pidato_detail.pidato_detail_id')
                                        ->where('pidato_pantun.pidato_detail_id', $d->pidato_detail_id)
                                        ->orderby('pidato_pantun.pidato_pantun_id', 'desc')
                                        ->findAll(); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge badge-pill rounded" style="background-color: #17a2b8; color: #fff;"><?= $d->kategori_judul ?></span>
                                            <p><?= $d->pidato_detail_judul ?></p>
                                            <?php foreach ($data as $p) : ?>
                                                <div style="background-color: #f0f0f0; padding: 20px; border: 1px solid #ccc;">
                                                    <?= $p->pidato_pantun_isi ?> <br>
                                                </div>

                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $pager->links('hal', 'paging') ?>
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