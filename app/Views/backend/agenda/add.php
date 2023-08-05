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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/agenda">Agenda</a></li>
                        <li class="breadcrumb-item active">Tambah Agenda</li>
                    </ol>
                </div>
                <h4 class="page-title">Agenda</h4>
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
                    <h4 class="mt-0 header-title">Form Tambah Agenda</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/agenda/save') ?>">
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul Agenda</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('agenda_judul')) ? 'is-invalid' : '' ?>" id="agenda_judul" placeholder="Masukkan Judul Agenda" name="agenda_judul" value="<?= old('agenda_judul') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?= ($validation->hasError('agenda_tanggal')) ? 'is-invalid' : '' ?>" id="agenda_tanggal" placeholder="Masukkan Judul Berita" name="agenda_tanggal" value="<?= old('agenda_tanggal') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_tanggal'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Jam</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control <?= ($validation->hasError('agenda_jam')) ? 'is-invalid' : '' ?>" id="agenda_jam" placeholder="Masukkan Judul Berita" name="agenda_jam" value="<?= old('agenda_jam') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_jam'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Lokasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('agenda_lokasi')) ? 'is-invalid' : '' ?>" id="agenda_lokasi" placeholder="Masukkan Lokasi" name="agenda_lokasi" value="<?= old('agenda_lokasi') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_lokasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Petugas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('agenda_petugas')) ? 'is-invalid' : '' ?>" id="agenda_petugas" placeholder="Masukkan Nama Petugas" name="agenda_petugas" value="<?= old('agenda_petugas') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_petugas'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/agenda" class="btn btn-gradient-danger">Cancel</a>
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