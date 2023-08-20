<!-- sidebar -->
<div class="sidebar">

    <div class="widget features-slide-widget">
        <div class="title-section">
            <h1><span>Berita Terbaru</span></h1>
        </div>
        <div class="image-post-slider">
            <ul class="bxslider">
                <?php foreach ($berita_baru as $d) : ?>
                    <li>
                        <div class="news-post image-post2">
                            <img src="<?= base_url('img/berita/' . $d->berita_detail_gambar) ?>" alt="">
                            <div class="hover-box">
                                <div class="inner-hover">
                                    <h2><a href="<?= base_url('berita/detail/' . $d->berita_slug . '/' . $d->berita_detail_slug) ?>"><?= $d->berita_detail_judul ?></a></h2>
                                    <ul class="post-tags">
                                        <?php
                                        $date = strtotime($d->created_at);
                                        $newDate = date('d/M/Y h:i:s', $date);
                                        ?>
                                        <li><i class="fa fa-clock-o"></i><?= $newDate ?></li>
                                        <li><i class="fa fa-user"></i>Editor: <?= $d->berita_detail_editor ?></li>
                                        <li><i class="fa fa-eye"></i><?= $d->berita_detail_dibaca ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
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
                            $date = strtotime($d->agenda_tanggal);
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
                                <br>
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

</div>
<!-- End sidebar -->