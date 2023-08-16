<?= $this->extend('frontend/master/index') ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- heading-news-section2
			================================================== -->
<section class="heading-news2">

    <div class="container">

        <!-- <div class="ticker-news-box">
            <span class="breaking-news">breaking news</span>
            <ul id="js-news">
                <li class="news-item"><span class="time-news">11:36 pm</span> <a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a> Donec odio. Quisque volutpat mattis eros... </li>
                <li class="news-item"><span class="time-news">12:40 pm</span> <a href="#">Dëshmitarja Abrashi: E kam parë Oliverin në turmë,</a> ndërsa neve na shpëtoi “çika Mille” </li>
                <li class="news-item"><span class="time-news">11:36 pm</span> <a href="#">Franca do të bashkëpunojë me Kosovën në fushën e shëndetësisë. </a></li>
                <li class="news-item"><span class="time-news">01:00 am</span> <a href="#">DioGuardi, kështu e mbrojti Kosovën në Washington, </a> para serbit Vejvoda </li>
            </ul>
        </div> -->

        <div class="iso-call heading-news-box">
            <div class="image-slider snd-size">
                <span class="top-stories">TOP STORIES</span>
                <ul class="bxslider">
                    <?php

                    use App\Models\GaleriKegiatanFotoModel;

                    foreach ($slider as $d) : ?>
                        <li>
                            <div class="news-post image-post">
                                <img src="<?= base_url('img/slider/' . $d->slider_gambar) ?>" alt="">
                                <div class="hover-box">
                                    <div class="inner-hover">
                                        <a class="category-post sport" href="#"><?= $d->slider_judul_1 ?></a>
                                        <h2><a href="#"><?= $d->slider_judul_2 ?></a></h2>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php foreach ($berita_atas as $d) : ?>
                <div class="news-post image-post default-size">
                    <img src="<?= base_url('img/berita/' . $d->berita_detail_gambar) ?>" alt="">
                    <div class="hover-box">
                        <div class="inner-hover">
                            <a class="category-post travel" href="<?= base_url('berita/detail/' . $d->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $d->berita_judul ?></a>
                            <h2><a href="<?= base_url('berita/detail/' . $d->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $d->berita_detail_judul ?></a></h2>
                            <ul class="post-tags">
                                <?php
                                $date = strtotime($d->created_at);
                                $newDate = date('d M Y', $date);
                                ?>
                                <li><i class="fa fa-clock-o"></i><span><?= $newDate ?></span></li>
                                <li><i class="fa fa-eye"></i><?= $d->berita_detail_dibaca ?></li>
                            </ul>
                            <?php
                            $kalimat = htmlentities(strip_tags($d->berita_detail_isi));
                            $desc = substr($kalimat, 0, 100);
                            $desc = substr($kalimat, 0, strrpos($desc, " "));
                            ?>
                            <p>
                                <?= $desc ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</section>
<!-- End heading-news-section -->

<!-- block-wrapper-section
================================================== -->
<section class="block-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">

                <!-- block content -->
                <div class="block-content">

                    <!-- article box -->
                    <div class="article-box">

                        <div class="title-section">
                            <h1><span>Berita</span></h1>
                        </div>
                        <?php foreach ($berita_atas as $d) : ?>
                            <div class="news-post article-post">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="post-gallery">
                                            <img alt="" src="<?= base_url('img/berita/' . $d->berita_detail_gambar) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('berita/detail/' . $d->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $d->berita_detail_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d M Y', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                                <li><i class="fa fa-user"></i>Editor: <?= $d->berita_detail_editor ?></li>
                                                <li><i class="fa fa-eye"></i><?= $d->berita_detail_dibaca ?></li>
                                            </ul>
                                            <?php
                                            $kalimat = htmlentities(strip_tags($d->berita_detail_isi));
                                            $desc = substr($kalimat, 0, 100);
                                            $desc = substr($kalimat, 0, strrpos($desc, " "));
                                            ?>
                                            <p><?= $desc ?></p>
                                            <a href="<?= base_url('berita/detail/' . $d->berita_slug . '/' . $d->berita_detail_slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- End article box -->

                    <!-- article box -->
                    <div class="article-box">

                        <div class="title-section">
                            <h1><span>Berita Foto</span></h1>
                        </div>

                        <?php foreach ($berita_foto as $d) : ?>
                            <div class="news-post article-post">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="post-gallery">
                                            <img alt="" src="<?= base_url('img/berita/' . $d->berita_foto_gambar) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('berita_foto/' . $d->berita_foto_slug) ?>"><?= $d->berita_foto_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d M Y', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                                <li><i class="fa fa-user"></i>Fotografer: <?= $d->berita_foto_fotografer ?></a></li>
                                            </ul>
                                            <?php
                                            $kalimat = htmlentities(strip_tags($d->berita_foto_deskripsi));
                                            $desc = substr($kalimat, 0, 100);
                                            $desc = substr($kalimat, 0, strrpos($desc, " "));
                                            ?>
                                            <p><?= $desc ?></p>
                                            <a href="<?= base_url('berita_foto/' . $d->berita_foto_slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- End article box -->

                    <!-- grid-box -->
                    <div class="grid-box">

                        <div class="title-section">
                            <h1><span class="world">Video Kegiatan</span></h1>
                        </div>

                        <div class="row">
                            <?php foreach ($video_kegiatan as $d) : ?>
                                <div class="col-md-4">
                                    <div class="news-post video-post">
                                        <img alt="" src="<?= base_url('img/berita/' . $d->video_kegiatan_foto) ?>">
                                        <a href="<?= $d->video_kegiatan_link ?>" class="video-link"><i class="fa fa-play-circle-o"></i></a>
                                        <div class="hover-box">
                                            <h2><a href="<?= base_url('video_kegiatan') ?>"><?= $d->video_kegiatan_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d M Y', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <!-- End grid-box -->

                    <!-- carousel box -->
                    <div class="carousel-box owl-wrapper">

                        <div class="title-section">
                            <h1><span class="world">Penghargaan</span></h1>
                        </div>

                        <div class="owl-carousel" data-num="2">
                            <?php
                            $no = 1;
                            foreach ($penghargaan as $d) :
                                if ($no == 1 || $no == 4) {
                            ?>
                                    <div class="item">
                                        <div class="news-post image-post2">
                                            <div class="post-gallery">
                                                <img src="<?= base_url('img/berita/' . $d->penghargaan_gambar) ?>" alt="">
                                                <div class="hover-box">
                                                    <div class="inner-hover">
                                                        <h2><a href="<?= base_url('penghargaan/' . $d->penghargaan_slug) ?>"><?= $d->penghargaan_judul ?></a></h2>
                                                        <ul class="post-tags">
                                                            <?php
                                                            $date = strtotime($d->created_at);
                                                            $newDate = date('d M Y', $date);
                                                            ?>
                                                            <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                if ($no == 2 || $no == 4) {
                                    ?>
                                        <ul class="list-posts">
                                        <?php
                                    }
                                    if ($no >= 2 && $no <= 3 || $no >= 4 && $no <= 6) {
                                        ?>
                                            <li>
                                                <img src="<?= base_url('img/berita/' . $d->penghargaan_gambar) ?>" alt="">
                                                <div class="post-content">
                                                    <h2><a href="<?= base_url('penghargaan/' . $d->penghargaan_slug) ?>"><?= $d->penghargaan_judul ?></a></h2>
                                                    <ul class="post-tags">
                                                        <?php
                                                        $date = strtotime($d->created_at);
                                                        $newDate = date('d M Y', $date);
                                                        ?>
                                                        <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php
                                    }
                                    if ($no == 3 || $no == 6) { ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            <?php
                                $no++;
                            endforeach; ?>

                        </div>

                    </div>
                    <!-- End carousel box -->

                    <!-- article box -->
                    <div class="article-box">

                        <div class="title-section">
                            <h1><span>Galeri Kegiatan</span></h1>
                        </div>
                        <?php foreach ($galeri_kegiatan as $d) : ?>
                            <div class="news-post article-post">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="post-gallery">
                                            <?php
                                            $galeriKegiatanFotoModel = new GaleriKegiatanFotoModel();
                                            $galeri_kegiatan_foto = $galeriKegiatanFotoModel
                                                ->where('galeri_kegiatan_id', $d->galeri_kegiatan_id)
                                                ->first();
                                            ?>
                                            <img alt="" src="<?= base_url('img/galeri/' . $galeri_kegiatan_foto->galeri_kegiatan_foto_file) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('galeri_foto/' . $d->galeri_kegiatan_slug) ?>"><?= $d->galeri_kegiatan_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d M Y', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                            </ul>
                                            <br>
                                            <a href="<?= base_url('galeri_foto/' . $d->galeri_kegiatan_slug) ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- End article box -->

                </div>
                <!-- End block content -->

            </div>

            <div class="col-sm-4">

                <!-- sidebar -->
                <div class="sidebar">

                    <div class="widget social-widget">
                        <div class="title-section">
                            <h1><span>Prokopim Berau</span></h1>
                        </div>
                        <ul class="social-share">
                            <li>
                                <a href="#" class="rss"><i class="fa fa-rss"></i></a>
                                <span class="number"><?= $jml_berita ?></span>
                                <span>Berita</span>
                            </li>
                            <li>
                                <a href="#" class="facebook"><i class="fa fa-camera"></i></a>
                                <span class="number"><?= $jml_galeri_foto ?></span>
                                <span>Galeri Foto</span>
                            </li>
                            <li>
                                <a href="#" class="twitter"><i class="fa fa-picture-o"></i></a>
                                <span class="number"><?= $jml_berita_foto ?></span>
                                <span>Berita Foto</span>
                            </li>
                            <li>
                                <a href="#" class="google"><i class="fa fa-youtube-play"></i></a>
                                <span class="number"><?= $jml_video_kegiatan ?></span>
                                <span>Video Kegiatan</span>
                            </li>
                        </ul>
                    </div>

                    <div class="widget tab-posts-widget">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#option1" data-toggle="tab">Agenda</a>
                            </li>
                            <li>
                                <a href="#option2" data-toggle="tab">Berita Populer</a>
                            </li>
                            <li>
                                <a href="#option3" data-toggle="tab">Download</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="option1">
                                <ul class="list-posts">
                                <?php foreach ($agenda_baru as $d) : ?>
                                    <li>
                                        <div class="events-date relative-position text-center rounded">
                                            <?php
                                            $date = strtotime($d->created_at);
                                            $newDate = date('d', $date);
                                            $newDateM = date('M Y', $date);
                                            ?>
                                            <span class="event-date"><?= $newDate ?></span>
                                            <?= $newDateM ?>
                                        </div>
                                        <!-- <img src="upload/news-posts/listw1.jpg" alt=""> -->
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('agenda/detail/' . $d->agenda_slug) ?>"><?= $d->agenda_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <li><i class="fa fa-clock-o"></i><?= $d->agenda_jam ?></li>
                                                <li><i class="fa fa-map-marker"></i><?= $d->agenda_lokasi ?></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="tab-pane" id="option2">
                                <ul class="list-posts">

                                <?php foreach ($berita_populer as $d) : ?>
                                    <li>
                                        <img src="<?= base_url('img/berita/' . $d->berita_detail_gambar) ?>" alt="">
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('berita/detail/' . $d->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $d->berita_detail_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d M Y', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                                <li><i class="fa fa-eye"></i><?= $d->berita_detail_dibaca ?></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="tab-pane" id="option3">
                                <ul class="list-posts">

                                <?php foreach ($download as $d) : ?>
                                    <li>
                                        <!-- <img src="upload/news-posts/listw1.jpg" alt=""> -->
                                        <div class="post-content">
                                            <h2><a href="<?= base_url('download/get_download/' . $d->download_detail_id) ?>"><?= $d->download_detail_judul ?></a></h2>
                                            <ul class="post-tags">
                                                <?php
                                                $date = strtotime($d->created_at);
                                                $newDate = date('d M Y', $date);
                                                ?>
                                                <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="widget features-slide-widget">
                        <div class="title-section">
                            <h1><span>Berita Foto</span></h1>
                        </div>
                        <div class="image-post-slider">
                            <ul class="bxslider">
                                <?php foreach ($berita_foto_slide as $d) : ?>
                                    <li>
                                        <div class="news-post image-post2">
                                            <div class="post-gallery">
                                                <img src="<?= base_url('img/berita/' . $d->berita_foto_gambar) ?>" alt="">
                                                <div class="hover-box">
                                                    <div class="inner-hover">
                                                        <h2><a href="<?= base_url('berita_foto/detail/' . $d->berita_foto_slug) ?>l"><?= $d->berita_foto_slug ?></a></h2>
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-clock-o"></i><?= $d->created_at ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="widget recent-comments-widget">
                        <div class="title-section">
                            <h1><span>Kontak Kami</span></h1>
                        </div>
                        <div class="owl-wrapper">
                            <div class="owl-carousel" data-num="1">
                                <div class="item">
                                    <ul class="comment-list">
                                        <?php

                                        use App\Models\KontakModel;

                                        $this->kontakModel = new KontakModel();
                                        foreach ($kontak as $d) :
                                            $balas = $this->kontakModel
                                                ->where('kontak_id_parent', $d->kontak_id)
                                                ->first(); ?>
                                        <li>
                                            <img alt="" src="<?= base_url('img/img_avatar3.png') ?>">
                                            <div class="comment-content">
                                                <p class="main-message">
                                                    <?= $d->kontak_nama ?>
                                                </p>
                                                <?php if ($balas) { ?>
                                                    <p><?= $balas->kontak_komentar ?></p>
                                                <?php } ?>
                                                <span><i class="fa fa-user"></i>Oleh <?= $d->kontak_nama ?></span>
                                            </div>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End sidebar -->

            </div>

        </div>

    </div>
</section>
<!-- End block-wrapper-section -->
<?= $this->endSection() ?>