<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!--Wysiwig js-->
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#penghargaan_gambar');
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/penghargaan">Penghargaan</a></li>
                        <li class="breadcrumb-item active">Tambah Penghargaan</li>
                    </ol>
                </div>
                <h4 class="page-title">Penghargaan</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Penghargaan</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/penghargaan/save') ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('penghargaan_judul')) ? 'is-invalid' : '' ?>" id="penghargaan_judul" placeholder="Masukkan Judul" name="penghargaan_judul" value="<?= old('penghargaan_judul') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penghargaan_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kategori_id">
                                        <?php foreach ($kategori as $k) : ?>
                                            <?php if ($k->kategori_id == old('kategori_id')) {
                                            ?>
                                                <option value="<?= $k->kategori_id ?>" selected><?= $k->kategori_judul ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $k->kategori_id ?>"><?= $k->kategori_judul ?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Tahun</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control <?= ($validation->hasError('penghargaan_tahun')) ? 'is-invalid' : '' ?>" id="penghargaan_tahun" placeholder="Masukkan Tahun" name="penghargaan_tahun" value="<?= old('penghargaan_tahun') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penghargaan_tahun'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('penghargaan_gambar')) ? 'is-invalid' : '' ?>" id="penghargaan_gambar" name="penghargaan_gambar" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penghargaan_gambar'); ?>
                                    </div>
                                    <label class="custom-file-label" for="penghargaan_gambar">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/default.jpg" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Isi</label>
                                <div class="col-sm-9">
                                    <textarea id="elm1" name="penghargaan_isi" class="form-control <?= ($validation->hasError('penghargaan_isi')) ? 'is-invalid' : '' ?>" id="penghargaan_isi"><?= old('penghargaan_isi') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penghargaan_isi'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/penghargaan" class="btn btn-gradient-danger">Cancel</a>
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