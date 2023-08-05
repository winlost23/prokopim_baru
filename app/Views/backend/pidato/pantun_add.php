<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!--Wysiwig js-->
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/pidato/pantun/<?= $pidato->pidato_detail_id ?>">Pantun (<?= $pidato->pidato_detail_judul ?>)</a></li>
                        <li class="breadcrumb-item active">Tambah Pantun</li>
                    </ol>
                </div>
                <h4 class="page-title">Pidato Pantun (<?= $pidato->pidato_detail_judul ?>)</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Pidato Pantun (<?= $pidato->pidato_detail_judul ?>)</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/pidato/pantun_save/' . $pidato->pidato_detail_id) ?>">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="kategori_id" value="<?= $pidato->kategori_id ?>">
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Isi</label>
                                <div class="col-sm-9">
                                    <textarea id="elm1" name="pidato_pantun_isi" class="form-control <?= ($validation->hasError('pidato_pantun_isi')) ? 'is-invalid' : '' ?>" id="pidato_pantun_isi"><?= old('pidato_pantun_isi') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pidato_pantun_isi'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/pidato/pantun/<?= $pidato->pidato_detail_id ?>" class="btn btn-gradient-danger">Cancel</a>
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