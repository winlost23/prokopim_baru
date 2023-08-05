<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!--Wysiwig js-->
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#berita_foto_gambar');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/berita_foto">Berita Foto</a></li>
                        <li class="breadcrumb-item active">Tambah Berita Foto</li>
                    </ol>
                </div>
                <h4 class="page-title">Berita Foto</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Berita Foto</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/berita_foto/save') ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('berita_foto_judul')) ? 'is-invalid' : '' ?>" id="berita_foto_judul" placeholder="Masukkan Judul Berita" name="berita_foto_judul" value="<?= old('berita_foto_judul') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_foto_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea id="elm1" name="berita_foto_deskripsi" class="form-control <?= ($validation->hasError('berita_foto_deskripsi')) ? 'is-invalid' : '' ?>" id="berita_foto_deskripsi"><?= old('berita_foto_deskripsi') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_foto_deskripsi'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('berita_foto_gambar')) ? 'is-invalid' : '' ?>" id="berita_foto_gambar" name="berita_foto_gambar" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_foto_gambar'); ?>
                                    </div>
                                    <label class="custom-file-label" for="berita_foto_gambar">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/default.jpg" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Fotografer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('berita_foto_fotografer')) ? 'is-invalid' : '' ?>" id="berita_foto_fotografer" placeholder="Masukkan Nama Fotografer" name="berita_foto_fotografer" value="<?= old('berita_foto_fotografer') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_foto_fotografer'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/berita_foto" class="btn btn-gradient-danger">Cancel</a>
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