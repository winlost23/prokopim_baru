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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/agenda">Agenda</a></li>
                        <li class="breadcrumb-item active">Edit Agenda</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Agenda</h4>
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
                    <h4 class="mt-0 header-title">Form Edit Agenda</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/agenda/update/' . $agenda->agenda_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="agenda_slug" value="<?= $agenda->agenda_slug ?>">
                            <input type="hidden" name="agenda_id" value="<?= $agenda->agenda_id ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul Agenda</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('agenda_judul')) ? 'is-invalid' : '' ?>" id="agenda_judul" name="agenda_judul" autofocus value="<?= (old('agenda_judul')) ? old('agenda_judul') : $agenda->agenda_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?= ($validation->hasError('agenda_tanggal')) ? 'is-invalid' : '' ?>" id="agenda_tanggal" name="agenda_tanggal" autofocus value="<?= (old('agenda_tanggal')) ? old('agenda_tanggal') : $agenda->agenda_tanggal ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_tanggal'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Jam</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control <?= ($validation->hasError('agenda_jam')) ? 'is-invalid' : '' ?>" id="agenda_jam" name="agenda_jam" autofocus value="<?= (old('agenda_jam')) ? old('agenda_jam') : $agenda->agenda_jam ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_jam'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Lokasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('agenda_lokasi')) ? 'is-invalid' : '' ?>" id="agenda_lokasi" name="agenda_lokasi" autofocus value="<?= (old('agenda_lokasi')) ? old('agenda_lokasi') : $agenda->agenda_lokasi ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('agenda_lokasi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Petugas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('agenda_petugas')) ? 'is-invalid' : '' ?>" id="agenda_petugas" name="agenda_petugas" autofocus value="<?= (old('agenda_petugas')) ? old('agenda_petugas') : $agenda->agenda_petugas ?>">
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