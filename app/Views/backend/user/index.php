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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                <h4 class="page-title">Users</h4>
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

                    <h4 class="mt-0 header-title">List Users</h4>
                    <p class="text-muted mb-3">Berikut adalah semua data user yang ada pada system ini...</p>
                    <?php if (session()->getFlashdata('tipe')) : ?>
                        <div class="alert alert-outline-<?= session()->getFlashdata('tipe') ?> b-round" role="alert">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>
                    <a href="<?= base_url('nimda/users/add') ?>" class="btn btn-gradient-secondary btn-clipboard" data-clipboard-action="copy" data-clipboard-target="#clipboardTextarea"><i class="fas fa-plus mr-2"></i>Tambah User</a>
                    <br>
                    <br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Last Login</th>
                                <th>Last IP</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $nomor = 1;
                            foreach ($user as $u) :
                            ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><img src="<?= base_url('avatar/' . $u->users_foto) ?>" alt="" class="rounded-circle thumb-sm mr-1"></td>
                                    <td><?= $u->users_name ?></td>
                                    <td><?= strftime("%d %b %Y %H:%M", strtotime($u->users_lastlogin)) ?></td>
                                    <td><?= $u->users_lastip ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('nimda/users/edit/' . $u->users_id) ?>" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="<?= base_url('nimda/users/delete/' . $u->users_id) ?>" onclick="return confirm('are you sure?')"><i class="fas fa-trash-alt text-danger font-16"></i></a>
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