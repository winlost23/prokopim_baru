<footer>
    <div class="container">
        <div class="footer-widgets-part">
            <div class="row">
                <div class="col-md-3">
                    <div class="widget categories-widget">
                        <h1>Profil</h1>
                        <ul class="category-list">
                            <?php foreach ($profil as $d) : ?>
                                <li>
                                    <a href="<?= base_url('profil/index/' . $d->profil_slug) ?>"><?= $d->profil_judul ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="widget social-widget">
                        <h1>Media Sosial</h1>
                        <ul class="social-icons">
                            <li><a href="<?= $pengaturan->pengaturan_facebook ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?= $pengaturan->pengaturan_email ?>" class="google"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?= $pengaturan->pengaturan_twitter ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="<?= $pengaturan->pengaturan_instagram ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget categories-widget">
                        <h1>Sekretariat</h1>
                        <ul class="category-list">
                            <?php foreach ($sekretariat as $d) : ?>
                                <li>
                                    <a href="<?= base_url('profil/index/' . $d->sekretariat_slug) ?>"><?= $d->sekretariat_judul ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget categories-widget">
                        <h1>Informasi</h1>
                        <ul class="category-list">
                            <li>
                                <a href="<?= base_url('berita_foto') ?>">Berita Foto <span>12</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('video_kegiatan') ?>">Video Kegiatan <span>26</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('pantun_pidato') ?>">Pantun Pidato <span>55</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('galeri_kegiatan') ?>">Galeri Kegiatan <span>37</span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('statstik_pantun_pidato') ?>">Statistik Pantun Pidato <span>62</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget text-widget">
                        <h1>Alamat Kantor</h1>
                        <p>ALAMAT</p>
                        <p><?= $pengaturan->pengaturan_alamat ?></p>
                        <br>
                        <p>TELEPON / FAX</p>
                        <p><?= $pengaturan->pengaturan_telp ?> / <?= $pengaturan->pengaturan_fax ?></p>
                        <br>
                        <p>EMAIL</p>
                        <p><?= $pengaturan->pengaturan_email ?></p>
                        <br>
                        <p>WEBSITE</p>
                        <p><?= $pengaturan->pengaturan_website ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-last-line">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; <?= date('Y') ?> Prokopim Pemerintah Kabupaten Buton Tengah</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer -->