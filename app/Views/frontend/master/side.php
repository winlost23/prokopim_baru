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
                <a href="#option2" data-toggle="tab">Pantun</a>
            </li>
            <li>
                <a href="#option3" data-toggle="tab">Berita Populer</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="option1">
                <ul class="list-posts">
                    <?php foreach ($agenda_baru as $d) : ?>
                        <li>
                            <!-- <img src="upload/news-posts/listw1.jpg" alt=""> -->
                            <div class="post-content">
                                <h2><a href="<?= base_url('agenda/detail/' . $d->agenda_slug) ?>"><?= $d->agenda_judul ?></a></h2>
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
            <div class="tab-pane" id="option2">
                <ul class="list-posts">

                    <li>
                        <img src="upload/news-posts/listw3.jpg" alt="">
                        <div class="post-content">
                            <h2><a href="single-post.html">Phasellus ultrices nulla quis nibh. Quisque a lectus. </a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <img src="upload/news-posts/listw4.jpg" alt="">
                        <div class="post-content">
                            <h2><a href="single-post.html">Donec consectetuer ligula vulputate sem tristique cursus. </a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <img src="upload/news-posts/listw5.jpg" alt="">
                        <div class="post-content">
                            <h2><a href="single-post.html">Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <img src="upload/news-posts/listw1.jpg" alt="">
                        <div class="post-content">
                            <h2><a href="single-post.html">Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. </a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <img src="upload/news-posts/listw2.jpg" alt="">
                        <div class="post-content">
                            <h2><a href="single-post.html">Sed arcu. Cras consequat.</a></h2>
                            <ul class="post-tags">
                                <li><i class="fa fa-clock-o"></i>27 may 2013</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="option3">
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
        </div>
    </div>

</div>
<!-- End sidebar -->