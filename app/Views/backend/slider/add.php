<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!--Wysiwig js-->
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#slider_gambar');
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/slider">Slider</a></li>
                        <li class="breadcrumb-item active">Tambah Slider</li>
                    </ol>
                </div>
                <h4 class="page-title">Slider</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Slider</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/slider/save') ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Text 1</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('slider_judul_1')) ? 'is-invalid' : '' ?>" id="slider_judul" placeholder="Masukkan Judul" name="slider_judul_1" value="<?= old('slider_judul_1') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('slider_judul_1'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Text 2</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('slider_judul_2')) ? 'is-invalid' : '' ?>" id="slider_judul_2" placeholder="Masukkan Judul" name="slider_judul_2" value="<?= old('slider_judul_2') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('slider_judul_2'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('slider_gambar')) ? 'is-invalid' : '' ?>" id="slider_gambar" name="slider_gambar" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('slider_gambar'); ?>
                                    </div>
                                    <label class="custom-file-label" for="slider_gambar">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/default.jpg" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/slider" class="btn btn-gradient-danger">Cancel</a>
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