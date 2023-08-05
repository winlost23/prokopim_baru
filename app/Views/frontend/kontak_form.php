<?= $this->extend('frontend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- block-wrapper-section
================================================== -->
<section class="block-wrapper left-sidebar">
    <div class="container">
        <div class="row">

            <div class="col-sm-8">

                <!-- block content -->
                <div class="block-content">

                    <!-- contact info box -->
                    <div class="contact-info-box">
                        <div class="title-section">
                            <h1><span>Isi Form Kontak</span></h1>
                        </div>
                        <p>Silahkan mengisi fasilitas komunikasi <b>Kontak Kami</b>. Mohon masukan dan pertanyaan disampaikan secara bijak dengan kata-kata yang baik. </p>
                        <p>Seluruh komentar yang masuk akan kami moderasi terlebih dahulu sebelum ditampilkan. Komentar yang mengandung unsur sara, <i>hoax</i>, pornografi, spam, ujaran kebencian, atau link tidak bermanfaat akan kami hapus.</p>
                    </div>
                    <!-- End contact info box -->

                    <!-- contact form box -->
                    <div class="contact-form-box">
                        <form id="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Nama Lengkap*</label>
                                    <input name="name" type="text">
                                </div>
                                <div class="col-md-6">
                                    <label for="mail">Pekerjaan*</label>
                                    <input name="mail" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">No. Telepon*</label>
                                    <input name="name" type="text">
                                </div>
                                <div class="col-md-6">
                                    <label for="mail">File PDF</label>
                                    <input name="mail" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Alamat*</label>
                                    <input name="name" type="text">
                                </div>
                                <div class="col-md-6">
                                    <label for="mail">E-mail*</label>
                                    <input name="mail" type="text">
                                </div>
                            </div>
                            <label for="comment">Komentar*</label>
                            <textarea id="comment" name="comment"></textarea>
                            <button type="submit" id="submit-contact">
                                <i class="fa fa-paper-plane"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                    <!-- End contact form box -->

                </div>
                <!-- End block content -->

            </div>

            <div class="col-sm-4">

                <?= $this->include('frontend/master/side') ?>

            </div>

        </div>

    </div>
</section>

<?= $this->endSection() ?>