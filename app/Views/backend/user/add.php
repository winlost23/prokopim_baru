<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/nimda/users">Users</a></li>
                        <li class="breadcrumb-item active">Tambah Users</li>
                    </ol>
                </div>
                <h4 class="page-title">Users</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Form Tambah User</h4>
                    <p class="text-muted mb-3">Silahkan lengkapi form dibawah ini...</p>
                    <?= $validation->getErrors() ? $validation->listErrors('my_list') : '' ?>
                    <div class="general-label">
                        <form method="post" action="<?= base_url('nimda/users/save') ?>" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Foto</label>
                                <div class="col-sm-9">
                                    <input type="file" name="foto">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" placeholder="Masukkan username..." name="name" value="<?= old('name') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="horizontalInput2" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="horizontalInput2" placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="horizontalInput2" class="col-sm-3 col-form-label">Ulangi Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="horizontalInput2" placeholder="Ulangi Password" name="password_ulangi">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-9 ml-auto">
                                    <button type="submit" class="btn btn-gradient-primary">Submit</button>
                                    <a href="<?= base_url() ?>/nimda/users" class="btn btn-gradient-danger">Cancel</a>
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