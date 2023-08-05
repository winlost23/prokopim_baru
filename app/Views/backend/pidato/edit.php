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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/pidato">Pidato</a></li>
                        <li class="breadcrumb-item active">Edit Pidato</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Pidato</h4>
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
                    <h4 class="mt-0 header-title">Form Edit Pidato</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/pidato/update/' . $pidato->pidato_detail_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="pidato_detail_slug" value="<?= $pidato->pidato_detail_slug ?>">
                            <input type="hidden" name="pidato_detail_id" value="<?= $pidato->pidato_detail_id ?>">
                            <input type="hidden" name="file_lama" value="<?= $pidato->pidato_detail_file ?>">
                            <input type="hidden" name="ext_lama" value="<?= $pidato->pidato_detail_ext ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('pidato_detail_judul')) ? 'is-invalid' : '' ?>" id="pidato_detail_judul" name="pidato_detail_judul" autofocus value="<?= (old('pidato_detail_judul')) ? old('pidato_detail_judul') : $pidato->pidato_detail_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pidato_detail_judul'); ?>
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
                                                if ($k->kategori_id == $pidato->kategori_id) {
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
                                <label for="nama" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9">
                                    <a href="<?= base_url('nimda/pidato/get_download/' . $pidato->pidato_detail_id) ?>" class="mr-2"><?= $pidato->pidato_detail_judul . '.' .  $pidato->pidato_detail_ext ?> <i class="fas fa-download text-warning font-16"></i></a>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Upload Ulang</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('pidato_detail_file')) ? 'is-invalid' : '' ?>" id="pidato_detail_file" placeholder="Masukkan Judul" name="pidato_detail_file" value="<?= old('pidato_detail_file') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pidato_detail_file'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Tanggal Acara</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?= ($validation->hasError('pidato_detail_tgl_acara')) ? 'is-invalid' : '' ?>" id="pidato_detail_tgl_acara" name="pidato_detail_tgl_acara" autofocus value="<?= (old('pidato_detail_tgl_acara')) ? old('pidato_detail_tgl_acara') : $pidato->pidato_detail_tgl_acara ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pidato_detail_tgl_acara'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Tempat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('pidato_detail_tempat')) ? 'is-invalid' : '' ?>" id="pidato_detail_tempat" name="pidato_detail_tempat" autofocus value="<?= (old('pidato_detail_tempat')) ? old('pidato_detail_tempat') : $pidato->pidato_detail_tempat ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pidato_detail_tempat'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/pidato" class="btn btn-gradient-danger">Cancel</a>
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