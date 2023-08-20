<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/tinymce/tinymce.min.js"></script>
<script src="<?= base_url() ?>/assets/pages/jquery.form-editor.init.js"></script>
<script>
    function previewImgHeader() {
        const sampul = document.querySelector('#pengaturan_logo_header');
        const sampulLabel = document.querySelector('.custom-file-label1');
        const imgPreview = document.querySelector('.img-preview1');

        sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImgFavicon() {
        const sampul = document.querySelector('#pengaturan_favicon');
        const sampulLabel = document.querySelector('.custom-file-label3');
        const imgPreview = document.querySelector('.img-preview3');

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
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </div>
                <h4 class="page-title">Pengaturan</h4>
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
                    <h4 class="mt-0 header-title">Logo dan Favicon</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>
                    <?php if (session()->getFlashdata('tipe')) : ?>
                        <div class="alert alert-outline-<?= session()->getFlashdata('tipe') ?> b-round" role="alert">
                            <?= session()->getFlashdata('pesan') ?>
                        </div>
                    <?php endif; ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/pengaturan/update/' . $pengaturan->pengaturan_id) ?>" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="pengaturan_id" value="<?= $pengaturan->pengaturan_id ?>">
                            <input type="hidden" name="pengaturan_logo_header_lama" value="<?= $pengaturan->pengaturan_logo_header ?>">

                            <input type="hidden" name="pengaturan_favicon_lama" value="<?= $pengaturan->pengaturan_favicon ?>">

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Logo Header</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('pengaturan_logo_header')) ? 'is-invalid' : '' ?>" id="pengaturan_logo_header" name="pengaturan_logo_header" onchange="previewImgHeader()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pengaturan_logo_header'); ?>
                                    </div>
                                    <label class="custom-file-label1" for="pengaturan_logo_header">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_logo_header; ?>" class="img-thumbnail img-preview1" style="width: 150px;">
                                </div>
                            </div>

                            <div class=" form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Favicon</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control <?= ($validation->hasError('pengaturan_favicon')) ? 'is-invalid' : '' ?>" id="pengaturan_favicon" name="pengaturan_favicon" onchange="previewImgFavicon()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pengaturan_favicon'); ?>
                                    </div>
                                    <label class="custom-file-label3" for="pengaturan_favicon">Pilih Gambar</label>
                                    <img src="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_favicon; ?>" class="img-thumbnail img-preview3" style="width: 150px;">
                                </div>
                            </div>
                    </div>
                </div>
                <!--end card-body-->


            </div>
            <!--end card-->

            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Alamat</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>

                    <div class="general-label">

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_alamat')) ? 'is-invalid' : '' ?>" id="pengaturan_alamat" name="pengaturan_alamat" autofocus value="<?= (old('pengaturan_alamat')) ? old('pengaturan_alamat') : $pengaturan->pengaturan_alamat ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_alamat'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Telp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_telp')) ? 'is-invalid' : '' ?>" id="pengaturan_telp" name="pengaturan_telp" autofocus value="<?= (old('pengaturan_telp')) ? old('pengaturan_telp') : $pengaturan->pengaturan_telp ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_telp'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Fax</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_fax')) ? 'is-invalid' : '' ?>" id="pengaturan_fax" name="pengaturan_fax" autofocus value="<?= (old('pengaturan_fax')) ? old('pengaturan_fax') : $pengaturan->pengaturan_fax ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_fax'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_email')) ? 'is-invalid' : '' ?>" id="pengaturan_email" name="pengaturan_email" autofocus value="<?= (old('pengaturan_email')) ? old('pengaturan_email') : $pengaturan->pengaturan_email ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_email'); ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Sosial Media</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>

                    <div class="general-label">

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Facebook</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_facebook')) ? 'is-invalid' : '' ?>" id="pengaturan_facebook" name="pengaturan_facebook" autofocus value="<?= (old('pengaturan_facebook')) ? old('pengaturan_facebook') : $pengaturan->pengaturan_facebook ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_facebook'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Twitter</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_twitter')) ? 'is-invalid' : '' ?>" id="pengaturan_twitter" name="pengaturan_twitter" autofocus value="<?= (old('pengaturan_twitter')) ? old('pengaturan_twitter') : $pengaturan->pengaturan_twitter ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_twitter'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Instagram</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_instagram')) ? 'is-invalid' : '' ?>" id="pengaturan_instagram" name="pengaturan_instagram" autofocus value="<?= (old('pengaturan_instagram')) ? old('pengaturan_instagram') : $pengaturan->pengaturan_instagram ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_instagram'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Youtube</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_youtube')) ? 'is-invalid' : '' ?>" id="pengaturan_youtube" name="pengaturan_youtube" autofocus value="<?= (old('pengaturan_youtube')) ? old('pengaturan_youtube') : $pengaturan->pengaturan_youtube ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_youtube'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Footer</h4>
                    <p class="text-muted mb-3">Silahkan ubah form dibawah ini...</p>

                    <div class="general-label">



                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Footer</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= ($validation->hasError('pengaturan_footer')) ? 'is-invalid' : '' ?>" id="pengaturan_footer" name="pengaturan_footer" autofocus value="<?= (old('pengaturan_footer')) ? old('pengaturan_footer') : $pengaturan->pengaturan_footer ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('pengaturan_footer'); ?>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-9 ml-auto">
                                <button type="submit" class="btn btn-gradient-primary">Submit</button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div> <!-- end row -->

</div><!-- container -->
<?= $this->endSection() ?>