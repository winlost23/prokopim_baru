<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>

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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/kontak">Kontak</a></li>
                        <li class="breadcrumb-item active">Balas kontak</li>
                    </ol>
                </div>
                <h4 class="page-title">Balas kontak</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Keluhan Pengguna</h4>
                    <p class="text-muted mb-3">Data keluhan pengguna ada dibawah ini...</p>

                    <div class="general-label">

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_nama ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_pekerjaan ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">No Telp.</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_telp ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_email ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_alamat ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Komentar</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_komentar ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">File</label>
                            <div class="col-sm-9">
                                <label for="nama" class="col-form-label">: <?= $kontak->kontak_file ?></label>
                            </div>
                        </div>
                        <hr />

                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Form Balas kontak</h4>
                    <p class="text-muted mb-3">Silahkan balas kontak form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/kontak/update/' . $kontak->kontak_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="kontak_id" value="<?= $kontak->kontak_id ?>">
                            <?php

                            use App\Models\KontakModel;

                            $this->kontakModel = new KontakModel();
                            $balas = $this->kontakModel->where('kontak_id_parent', $kontak->kontak_id)->where('kontak_sebagai', '2')->first();
                            ?>
                            <div class="form-group row">

                                <label for="email" class="col-sm-2 col-form-label">Komentar</label>
                                <?php if ($balas) { ?>
                                    <input type="hidden" name="kontak_id_admin" value="<?= $balas->kontak_id ?>">
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="kontak_komentar" class="form-control <?= ($validation->hasError('kontak_komentar')) ? 'is-invalid' : '' ?>" id="kontak_komentar"><?= (old('kontak_komentar')) ? old('kontak_komentar') : $balas->kontak_komentar ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kontak_komentar'); ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <input type="hidden" name="kontak_id_admin" value="0">
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="kontak_komentar" class="form-control <?= ($validation->hasError('kontak_komentar')) ? 'is-invalid' : '' ?>" id="kontak_komentar"><?= old('kontak_komentar') ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kontak_komentar'); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-10 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/kontak" class="btn btn-gradient-danger">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
    </div> <!-- end row -->

</div><!-- container -->
<?= $this->endSection() ?>