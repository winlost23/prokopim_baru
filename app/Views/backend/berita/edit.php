<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImg() {
        const sampul = document.querySelector('#berita_gambar');
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/berita">Berita</a></li>
                        <li class="breadcrumb-item active">Edit Berita</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Berita</h4>
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
                    <h4 class="mt-0 header-title">Form Edit Berita</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/berita/update/' . $berita->berita_detail_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="berita_detail_slug" value="<?= $berita->berita_detail_slug ?>">
                            <input type="hidden" name="berita_gambar_lama" value="<?= $berita->berita_detail_gambar ?>">
                            <input type="hidden" name="berita_detail_id" value="<?= $berita->berita_detail_id ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('berita_detail_judul')) ? 'is-invalid' : '' ?>" id="berita_detail_judul" name="berita_detail_judul" autofocus value="<?= (old('berita_detail_judul')) ? old('berita_detail_judul') : $berita->berita_detail_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_detail_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="berita_id">
                                        <?php foreach ($kategori as $k) : ?>
                                            <?php if (old('berita_id') != '') {
                                                if ($k->berita_id == old('berita_id')) {
                                            ?>
                                                    <option value="<?= $k->berita_id ?>" selected><?= $k->berita_judul ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $k->berita_id ?>"><?= $k->berita_judul ?></option>
                                                <?php
                                                }
                                            } else {
                                                if ($k->berita_id == $berita->berita_id) {
                                                ?>
                                                    <option value="<?= $k->berita_id ?>" selected><?= $k->berita_judul ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $k->berita_id ?>"><?= $k->berita_judul ?></option>
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
                                    <textarea id="elm1" name="berita_detail_isi" class="form-control <?= ($validation->hasError('berita_detail_isi')) ? 'is-invalid' : '' ?>" id="berita_detail_isi"><?= (old('berita_detail_isi')) ? old('berita_detail_isi') : $berita->berita_detail_isi ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_detail_isi'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('berita_detail_gambar')) ? 'is-invalid' : '' ?>" id="berita_detail_gambar" name="berita_detail_gambar" onchange="previewImg()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_detail_gambar'); ?>
                                    </div>
                                    <label class="custom-file-label" for="berita_detail_gambar">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/berita/<?= $berita->berita_detail_gambar; ?>" class="img-thumbnail img-preview" style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Editor</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('berita_detail_editor')) ? 'is-invalid' : '' ?>" id="berita_detail_editor" name="berita_detail_editor" autofocus value="<?= (old('berita_detail_editor')) ? old('berita_detail_editor') : $berita->berita_detail_editor ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_detail_editor'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Reporter</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('berita_detail_rep')) ? 'is-invalid' : '' ?>" id="berita_detail_rep" name="berita_detail_rep" autofocus value="<?= (old('berita_detail_rep')) ? old('berita_detail_rep') : $berita->berita_detail_rep ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_detail_rep'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Fotografer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('berita_detail_foto')) ? 'is-invalid' : '' ?>" id="berita_detail_foto" name="berita_detail_foto" autofocus value="<?= (old('berita_detail_foto')) ? old('berita_detail_foto') : $berita->berita_detail_foto ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('berita_detail_foto'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/berita" class="btn btn-gradient-danger">Cancel</a>
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