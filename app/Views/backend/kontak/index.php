<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<link href="<?= base_url() ?>/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?= base_url() ?>/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    })
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kontak</li>
                    </ol>
                </div>
                <h4 class="page-title">Kontak</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">List Kontak</h4>
                    <p class="text-muted mb-3">Berikut adalah semua data kontak yang ada pada system ini...</p>
                    <?php if (session()->getFlashdata('tipe')) : ?>
                        <div class="alert alert-outline-<?= session()->getFlashdata('tipe') ?> b-round" role="alert">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Pesan</th>
                                <th>Admin Balas</th>
                                <th>Balas</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php

                            use App\Models\KontakModel;

                            $this->kontakModel = new KontakModel();

                            $nomor = 1;
                            foreach ($kontak as $u) :
                                $balas = $this->kontakModel->where('kontak_id_parent', $u->kontak_id)->where('kontak_sebagai', '2')->first();
                            ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $u->kontak_nama ?></td>
                                    <td><?= $u->kontak_komentar ?></td>
                                    <?php if ($balas) { ?>
                                        <td><?= $balas->kontak_komentar ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('nimda/kontak/balas/' . $u->kontak_id) ?>" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        </td>
                                    <?php } else { ?>
                                        <td style="color: brown;">Belum Dibalas</td>
                                        <td class="text-center">
                                            <a href="<?= base_url('nimda/kontak/balas/' . $u->kontak_id) ?>" class="mr-2"><i class="fas fa-edit text-success font-16"></i></a>
                                        </td>
                                    <?php } ?>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
<?= $this->endSection() ?>