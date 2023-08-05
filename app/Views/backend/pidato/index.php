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
                        <li class="breadcrumb-item active">Pidato</li>
                    </ol>
                </div>
                <h4 class="page-title">Pidato</h4>
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

                    <h4 class="mt-0 header-title">List Pidato</h4>
                    <p class="text-muted mb-3">Berikut adalah semua data pidato yang ada pada system ini...</p>
                    <?php if (session()->getFlashdata('tipe')) : ?>
                        <div class="alert alert-outline-<?= session()->getFlashdata('tipe') ?> b-round" role="alert">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>
                    <a href="<?= base_url('nimda/pidato/add') ?>" class="btn btn-gradient-secondary btn-clipboard" data-clipboard-action="copy" data-clipboard-target="#clipboardTextarea"><i class="fas fa-plus mr-2"></i>Tambah Pidato</a>
                    <br>
                    <br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pantun</th>
                                <th>File Pidato</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php

                            use App\Models\PidatoPantunModel;

                            $this->pidatopantunModel = new PidatoPantunModel();
                            // $data['pantun'] = $this->pidatopantunModel->where('pidato_detail_id', $u->pidato_detail_id)->count();
                            $nomor = 1;
                            foreach ($pidato as $u) :
                                $count = $this->pidatopantunModel->where('pidato_detail_id', $u->pidato_detail_id)->countAllResults();
                            ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $u->pidato_detail_judul ?></td>
                                    <td><?= $u->kategori_judul ?></td>
                                    <td>(<?= $count ?>)<a href="<?= base_url('nimda/pidato/pantun/' . $u->pidato_detail_id) ?>" class="mr-2"> <i class="fas fa-plus text-success font-16"></i></td>
                                    <td><a href="<?= base_url('nimda/pidato/get_download/' . $u->pidato_detail_id) ?>" class="mr-2"><i class="fas fa-download text-warning font-16"></i></a></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('nimda/pidato/edit/' . $u->pidato_detail_id) ?>" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="<?= base_url('nimda/pidato/delete/' . $u->pidato_detail_id) ?>" onclick="return confirm('are you sure?')"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                    </td>
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