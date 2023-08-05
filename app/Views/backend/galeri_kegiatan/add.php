<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    function previewImg() {
        const sampul = document.querySelector('#kategori_gambar');
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/galeri_kegiatan">Galeri Kegiatan</a></li>
                        <li class="breadcrumb-item active">Tambah Galeri Kegiatan</li>
                    </ol>
                </div>
                <h4 class="page-title">Galeri Kegiatan</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Galeri Kegiatan</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/galeri_kegiatan/save') ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul Galeri</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('galeri_kegiatan_judul')) ? 'is-invalid' : '' ?>" id="galeri_kegiatan_judul" placeholder="Masukkan Judul Galeri" name="galeri_kegiatan_judul" value="<?= old('galeri_kegiatan_judul') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('galeri_kegiatan_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Fotografer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('galeri_kegiatan_fotografer')) ? 'is-invalid' : '' ?>" id="galeri_kegiatan_fotografer" placeholder="Masukkan Nama Fotografer" name="galeri_kegiatan_fotografer" value="<?= old('galeri_kegiatan_fotografer') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('galeri_kegiatan_fotografer'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/galeri_kegiatan" class="btn btn-gradient-danger">Cancel</a>
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