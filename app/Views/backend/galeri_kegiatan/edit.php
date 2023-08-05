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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/galeri_kegiatan">Galeri</a></li>
                        <li class="breadcrumb-item active">Edit Galeri</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Galeri</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Form Edit Galeri</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/galeri_kegiatan/update/' . $galeri->galeri_kegiatan_id) ?>">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="galeri_kegiatan_id" value="<?= $galeri->galeri_kegiatan_id ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul Galeri</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('galeri_kegiatan_judul')) ? 'is-invalid' : '' ?>" id="galeri_kegiatan_judul" name="galeri_kegiatan_judul" autofocus value="<?= (old('galeri_kegiatan_judul')) ? old('galeri_kegiatan_judul') : $galeri->galeri_kegiatan_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('galeri_kegiatan_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Fotografer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('galeri_kegiatan_fotografer')) ? 'is-invalid' : '' ?>" id="galeri_kegiatan_fotografer" name="galeri_kegiatan_fotografer" autofocus value="<?= (old('galeri_kegiatan_fotografer')) ? old('galeri_kegiatan_fotografer') : $galeri->galeri_kegiatan_fotografer ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('galeri_kegiatan_fotografer'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/galeri" class="btn btn-gradient-danger">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div> <!-- end row -->

</div><!-- container -->
<?= $this->endSection() ?>