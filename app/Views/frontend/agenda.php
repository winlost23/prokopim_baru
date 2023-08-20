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

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Agenda</th>
                                    <th>Tanggal</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$no = 1;
                                foreach ($konten as $d) : ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $d->agenda_judul ?></td>
                                        <?php
                                        $date = strtotime($d->agenda_tanggal);
                                        $newDate = date('d M Y', $date);
                                        ?>
                                        <td><?= $newDate ?></td>
                                        <td>
                                            <a href="<?= base_url('agenda/detail/' . $d->agenda_slug) ?>" class="btn btn-danger btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?= $pager->links('agenda', 'paging') ?>
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