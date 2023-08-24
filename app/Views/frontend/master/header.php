<!-- Header
		    ================================================== -->
<header class="clearfix second-style">
    <!-- Bootstrap navbar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">

        <!-- Top line -->
        <div class="top-line">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <ul class="top-line-list">
                            <li><span class="time-now"><i class="fa fa-send"></i> Terwujudnya Kabupaten Berau yang Bermarwah, Maju dan Sejahtera</span></li>
                            <!-- <li><span class="time-now">Thursday 8 January 2015 / 21:20</span></li>
                            <li><a href="#">Log In</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="#">Purchase Theme</a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="social-icons">
                            <?php if($pengaturan->pengaturan_facebook != ''){ ?>
                                <li><a class="facebook" href="<?= $pengaturan->pengaturan_facebook ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php if($pengaturan->pengaturan_twitter != ''){ ?>
                                <li><a class="twitter" href="<?= $pengaturan->pengaturan_twitter ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php if($pengaturan->pengaturan_youtube != ''){ ?>
                                <li><a class="youtube" href="<?= $pengaturan->pengaturan_youtube ?>"><i class="fa fa-youtube"></i></a></li>
                            <?php } ?>
                            <?php if($pengaturan->pengaturan_instagram != ''){ ?>
                                <li><a class="instagram" href="<?= $pengaturan->pengaturan_instagram ?>"><i class="fa fa-instagram"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top line -->

        <!-- Logo & advertisement -->
        <div class="logo-advertisement">
            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url('home') ?>"><img src="<?= base_url('img/' . $pengaturan->pengaturan_logo_header) ?>" alt="" width="348"></a>
                </div>

                <div class="advertisement">
                    <div class="desktop-advert">
                        <span>&nbsp;</span>
                        <img src="<?= base_url('img/' . $pengaturan->pengaturan_banner) ?>" alt="">
                    </div>
                </div>

            </div>
        </div>
        <!-- End Logo & advertisement -->

        <!-- navbar list container -->
        <div class="nav-list-container">
            <div class="container">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">

                        <li class="menu_non"><a class="home" href="<?= base_url('home/') ?>">Home</a></li>

                        <li class="drop"><a class="world" href="#">Profil</a>
                            <ul class="dropdown world-dropdown">
                                <?php
                                foreach ($profil as $d) :
                                ?>
                                    <li><a href="<?= base_url('profil/index/' . $d->profil_slug) ?>"><?= $d->profil_judul ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </li>
                        <li class="drop"><a class="travel" href="#">Sekretariat</a>
                            <ul class="dropdown travel-dropdown">
                                <?php
                                foreach ($sekretariat as $d) :
                                ?>
                                    <li><a href="<?= base_url('sekretariat/index/' . $d->sekretariat_slug) ?>"><?= $d->sekretariat_judul ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </li>
                        <li class="drop"><a class="tech" href="#">Berita</a>
                            <ul class="dropdown tech-dropdown">
                                <?php
                                foreach ($berita as $d) :
                                ?>
                                    <li><a href="<?= base_url('berita/' . $d->berita_slug) ?>"><?= $d->berita_judul ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </li>
                        <li class="drop"><a class="fashion" href="#">Pidato</a>
                            <ul class="dropdown fashion-dropdown">
                                <?php
                                foreach ($kategori as $d) :
                                ?>
                                    <li><a href="<?= base_url('pidato/index/' . $d->kategori_slug) ?>"><?= $d->kategori_judul ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </li>
                        <li class="drop"><a class="video" href="#">Multimedia</a>
                            <ul class="dropdown video-dropdown">
                                <li><a href="<?= base_url('berita_foto') ?>">Berita Foto</a></li>
                                <li><a href="<?= base_url('video_kegiatan') ?>">Video Kegiatan</a></li>
                                <li><a href="<?= base_url('pantun_pidato') ?>">Pantun Pidato</a></li>
                                <li><a href="<?= base_url('galeri_kegiatan') ?>">Galeri Kegiatan</a></li>
                                <li><a href="<?= base_url('statstik_pantun_pidato') ?>">Stastik Pantun Pidato</a></li>
                            </ul>
                        </li>

                        <li class="menu_non"><a class="sport" href="<?= base_url('agenda') ?>">Agenda</a></li>

                        <li class="drop"><a class="food" href="#">Download</a>
                            <ul class="dropdown food-dropdown">
                                <?php
                                foreach ($download_menu as $d) :
                                ?>
                                    <li><a href="<?= base_url('download/index/' . $d->download_slug) ?>"><?= $d->download_judul ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </li>

                        <li class="menu_non"><a class="features" href="<?= base_url('penghargaan') ?>">Penghargaan</a></li>

                        <li class="menu_non"><a class="travel" href="<?= base_url('kontak') ?>">Kontak</a></li>

                    </ul>
                    <form class="navbar-form navbar-right" role="search" method="post" action="<?= base_url('home/cari') ?>">
                        <input type="text" id="search" name="berita_detail_judul" placeholder="Search here">
                        <button type="submit" id="search-submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </div>
        <!-- End navbar list container -->

    </nav>
    <!-- End Bootstrap navbar -->

</header>
<!-- End Header -->