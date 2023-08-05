<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#galeri_kegiatan_foto_file');
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
                        <li class="breadcrumb-item"><a href="<?= base_url('nimda') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('nimda/galeri_kegiatan') ?>">Galeri</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('nimda/galeri_kegiatan/detail/' . $galeri->galeri_kegiatan_id) ?>">Detail</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Galeri <?= $galeri->galeri_kegiatan_judul ?></h4>
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
                    <h4 class="mt-0 header-title">Form Edit Galeri <?= $galeri->galeri_kegiatan_judul ?></h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/galeri_kegiatan/updateDetail/' . $galeri->galeri_kegiatan_id . '/' . $foto->galeri_kegiatan_foto_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="galeri_gambar_lama" value="<?= $foto->galeri_kegiatan_foto_file ?>">
                            <input type="hidden" name="galeri_kegiatan_foto_id" value="<?= $foto->galeri_kegiatan_foto_id ?>">
                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('galeri_kegiatan_foto_file')) ? 'is-invalid' : '' ?>" id="galeri_kegiatan_foto_file" name="galeri_kegiatan_foto_file" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('galeri_kegiatan_foto_file'); ?>
                                    </div>
                                    <label class="custom-file-label" for="galeri_kegiatan_foto_file">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/galeri/<?= $foto->galeri_kegiatan_foto_file; ?>" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url('nimda/galeri_kegiatan/detail/' . $galeri->galeri_kegiatan_id) ?>" class="btn btn-gradient-danger">Cancel</a>
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