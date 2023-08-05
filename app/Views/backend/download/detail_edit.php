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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/download">Download</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/download/detail/<?= $data->download_id ?>"><?= $data->download_judul ?></a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Download (<?= $data->download_judul ?>)</h4>
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
                    <h4 class="mt-0 header-title">Form Edit Download (<?= $data->download_judul ?>)</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/download/detail_update/' . $data->download_id . '/' . $download->download_detail_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="download_detail_slug" value="<?= $download->download_detail_slug ?>">
                            <input type="hidden" name="download_detail_id" value="<?= $download->download_detail_id ?>">
                            <input type="hidden" name="file_lama" value="<?= $download->download_detail_file ?>">
                            <input type="hidden" name="ukuran_lama" value="<?= $download->download_detail_ukuran ?>">
                            <input type="hidden" name="ext_lama" value="<?= $download->download_detail_ext ?>">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= ($validation->hasError('download_detail_judul')) ? 'is-invalid' : '' ?>" id="download_detail_judul" name="download_detail_judul" autofocus value="<?= (old('download_detail_judul')) ? old('download_detail_judul') : $download->download_detail_judul ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('download_detail_judul'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9">
                                    <a href="<?= base_url('nimda/download/get_download/' . $data->download_id . '/' . $download->download_detail_id) ?>" class="mr-2"><?= $download->download_detail_judul . '.' .  $download->download_detail_ext ?> <i class="fas fa-download text-warning font-16"></i></a>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Upload Ulang</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('download_detail_file')) ? 'is-invalid' : '' ?>" id="download_detail_file" placeholder="Masukkan Judul" name="download_detail_file" value="<?= old('download_detail_file') ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('download_detail_file'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/download/detail/<?= $data->download_id ?>" class="btn btn-gradient-danger">Cancel</a>
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