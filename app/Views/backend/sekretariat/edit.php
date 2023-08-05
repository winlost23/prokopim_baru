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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/sekretariat">Sekretariat</a></li>
                        <li class="breadcrumb-item active">Edit Sekretariat</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Sekretariat</h4>
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
                    <h4 class="mt-0 header-title">Form Edit Sekretariat</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/sekretariat/update/' . $sekretariat->sekretariat_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="sekretariat_slug" value="<?= $sekretariat->sekretariat_slug ?>">
                            <input type="hidden" name="sekretariat_id" value="<?= $sekretariat->sekretariat_id ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('sekretariat_judul')) ? 'is-invalid' : '' ?>" id="sekretariat_judul" name="sekretariat_judul" autofocus value="<?= (old('sekretariat_judul')) ? old('sekretariat_judul') : $sekretariat->sekretariat_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sekretariat_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Isi</label>
                                <div class="col-sm-9">
                                    <textarea id="elm1" name="sekretariat_isi" class="form-control <?= ($validation->hasError('sekretariat_isi')) ? 'is-invalid' : '' ?>" id="sekretariat_isi"><?= (old('sekretariat_isi')) ? old('sekretariat_isi') : $sekretariat->sekretariat_isi ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sekretariat_isi'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/sekretariat" class="btn btn-gradient-danger">Cancel</a>
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