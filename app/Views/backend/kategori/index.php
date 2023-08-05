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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/<?= $segmentasi ?>"><?= ucfirst($segmentasi); ?></a></li>
                        <li class="breadcrumb-item active">Ketegori <?= ucfirst($segmentasi); ?></li>
                    </ol>
                </div>
                <h4 class="page-title">Kategori</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Form Tambah Kategori <?= ucfirst($segmentasi); ?></h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/kategori/save') ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="kategori_jenis" value="<?= $segmentasi ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('kategori_judul')) ? 'is-invalid' : '' ?>" id="kategori_judul" placeholder="Kategori <?= ucfirst($segmentasi); ?>" name="kategori_judul" value="<?= old('kategori_judul') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kategori_judul'); ?>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Kategori <?= ucfirst($segmentasi); ?></h4>
                    <p class="text-muted mb-3">Berikut adalah semua data berita yang ada pada system ini...</p>
                    <?php

                    use App\Models\BeritaModel;

                    if (session()->getFlashdata('tipe')) : ?>
                        <div class="alert alert-outline-<?= session()->getFlashdata('tipe') ?> b-round" role="alert">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <?= ($segmentasi == 'berita') ? '<th>Jumlah Berita</th>' : ''; ?>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $nomor = 1;
                            foreach ($kategori as $u) :
                            ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $u->kategori_judul ?></td>
                                    <?php
                                    if ($segmentasi == "berita") {
                                        $this->beritaModel = new BeritaModel();
                                        $berita = $this->beritaModel->where('kategori_id', $u->kategori_id)->countAllResults();
                                        echo '<td>' . $berita . '</td>';
                                    }
                                    ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('nimda/kategori/edit/' . $segmentasi . '/' . $u->kategori_id) ?>" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                        <a href="<?= base_url('nimda/kategori/delete/' . $segmentasi . '/' . $u->kategori_id) ?>" onclick="return confirm('are you sure?')"><i class="fas fa-trash-alt text-danger font-16"></i></a>
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