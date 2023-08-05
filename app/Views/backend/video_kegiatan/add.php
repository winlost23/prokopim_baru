<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!--Wysiwig js-->
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#video_kegiatan_foto');
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/video_kegiatan">Video Kegiatan</a></li>
                        <li class="breadcrumb-item active">Tambah Video Kegiatan</li>
                    </ol>
                </div>
                <h4 class="page-title">Video Kegiatan</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Video Kegiatan</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/video_kegiatan/save') ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('video_kegiatan_judul')) ? 'is-invalid' : '' ?>" id="video_kegiatan_judul" placeholder="Masukkan Judul Video" name="video_kegiatan_judul" value="<?= old('video_kegiatan_judul') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('video_kegiatan_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Link Youtube</label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control <?= ($validation->hasError('video_kegiatan_link')) ? 'is-invalid' : '' ?>" id="video_kegiatan_link" placeholder="Masukkan Link Video Youtube" name="video_kegiatan_link" value="<?= old('video_kegiatan_link') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('video_kegiatan_link'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('video_kegiatan_foto')) ? 'is-invalid' : '' ?>" id="video_kegiatan_foto" name="video_kegiatan_foto" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('video_kegiatan_foto'); ?>
                                    </div>
                                    <label class="custom-file-label" for="video_kegiatan_foto">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/default.jpg" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Videografer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('video_kegiatan_videografer')) ? 'is-invalid' : '' ?>" id="video_kegiatan_videografer" placeholder="Masukkan Nama Videografer" name="video_kegiatan_videografer" value="<?= old('video_kegiatan_videografer') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('video_kegiatan_videografer'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/video_kegiatan" class="btn btn-gradient-danger">Cancel</a>
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