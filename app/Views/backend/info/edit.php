<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#info_gambar');
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">UI Kit</a></li>
                        <li class="breadcrumb-item active">Edit Info</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Info</h4>
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
                    <h4 class="mt-0 header-title">Form Edit Info</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/info/update/' . $info->info_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="info_slug" value="<?= $info->info_slug ?>">
                            <input type="hidden" name="info_gambar_lama" value="<?= $info->info_gambar ?>">
                            <input type="hidden" name="info_id" value="<?= $info->info_id ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="info_judul" name="info_judul" autofocus value="<?= (old('info_judul')) ? old('info_judul') : $info->info_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('info_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kategori_id">
                                        <?php foreach ($kategori as $k) : ?>
                                            <?php if (old('kategori_id') != '') {
                                                if ($k->kategori_id == old('kategori_id')) {
                                            ?>
                                                    <option value="<?= $k->kategori_id ?>" selected><?= $k->kategori_judul ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $k->kategori_id ?>"><?= $k->kategori_judul ?></option>
                                                <?php
                                                }
                                            } else {
                                                if ($k->kategori_id == $info->kategori_id) {
                                                ?>
                                                    <option value="<?= $k->kategori_id ?>" selected><?= $k->kategori_judul ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $k->kategori_id ?>"><?= $k->kategori_judul ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Isi</label>
                                <div class="col-sm-9">
                                    <textarea id="elm1" name="info_isi" class="form-control <?= ($validation->hasError('info_isi')) ? 'is-invalid' : '' ?>" id="info_isi"><?= (old('info_isi')) ? old('info_isi') : $info->info_isi ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('info_isi'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('info_gambar')) ? 'is-invalid' : '' ?>" id="info_gambar" name="info_gambar" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('info_gambar'); ?>
                                    </div>
                                    <label class="custom-file-label" for="info_gambar">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/info/<?= $info->info_gambar; ?>" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/info" class="btn btn-gradient-danger">Cancel</a>
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