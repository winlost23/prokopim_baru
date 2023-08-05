<?= $this->extend('backend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/plugins/apexcharts/apexcharts.min.js"></script>
<!--script src="<?= base_url() ?>/assets/pages/jquery.helpdesk-dashboard.init.js"></script-->
<?php
$bulans = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des');
?>
<script>
    /**
     * Theme: Crovex - Responsive Bootstrap 4 Admin Dashboard
     * Author: Mannatthemes
     * Dashboard Js
     */

    //colunm-1

    var options = {
        chart: {
            height: 300,
            type: 'bar',
            toolbar: {
                show: false
            },
            dropShadow: {
                enabled: true,
                top: 0,
                left: 5,
                bottom: 5,
                right: 0,
                blur: 5,
                color: '#45404a2e',
                opacity: 0.35
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded',
                columnWidth: '25%',
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ["#2c77f4", "#1ecab8"],
        series: [{
            name: 'User',
            data: [
                <?php
                foreach ($pengunjung as $show) {
                    echo $show->jml . ",";
                }
                $jmlbulan = count($pengunjung);
                ?>
            ]
        }, ],
        xaxis: {
            categories: [
                <?php
                for ($x = 0; $x < $jmlbulan; $x++) {
                    echo "'" . $bulans[$x] . "',";
                }
                ?>
            ],
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: true,
            },
        },
        legend: {
            offsetY: -10,
        },
        yaxis: {
            title: {
                text: 'Pengguna'
            }
        },
        fill: {
            opacity: 1,
        },
        // legend: {
        //     floating: true
        // },
        grid: {
            row: {
                colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.2
            },
            borderColor: '#f1f3fa'
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "" + val + ""
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#ana_dash_1"),
        options
    );

    chart.render();


    // saprkline chart


    var dash_spark_1 = {

        chart: {
            type: 'area',
            height: 60,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 12,
                left: 0,
                bottom: 5,
                right: 0,
                blur: 2,
                color: '#45404a2e',
                opacity: 0.1
            },
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        fill: {
            opacity: 1,
            gradient: {
                shade: '#2c77f4',
                type: "horizontal",
                shadeIntensity: 0.5,
                inverseColors: true,
                opacityFrom: 0.1,
                opacityTo: 0.1,
                stops: [0, 80, 100],
                colorStops: []
            },
        },
        series: [{
            data: [4, 8, 5, 10, 4, 16, 5, 11, 6, 11, 30, 10, 13, 4, 6, 3, 6]
        }],
        yaxis: {
            min: 0
        },
        colors: ['#2c77f4'],
    }
    new ApexCharts(document.querySelector("#dash_spark_1"), dash_spark_1).render();


    var dash_spark_2 = {

        chart: {
            type: 'area',
            height: 60,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 12,
                left: 0,
                bottom: 5,
                right: 0,
                blur: 2,
                color: '#45404a2e',
                opacity: 0.1
            },
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        fill: {
            opacity: 1,
            gradient: {
                shade: '#fd3c97',
                type: "horizontal",
                shadeIntensity: 0.5,
                inverseColors: true,
                opacityFrom: 0.1,
                opacityTo: 0.1,
                stops: [0, 80, 100],
                colorStops: []
            },
        },
        series: [{
            data: [4, 8, 5, 10, 4, 25, 5, 11, 6, 11, 5, 10, 3, 14, 6, 8, 6]
        }],
        yaxis: {
            min: 0
        },
        colors: ['#fd3c97'],
    }
    new ApexCharts(document.querySelector("#dash_spark_2"), dash_spark_2).render();



    //Device-widget


    var options = {
        chart: {
            height: 280,
            type: 'donut',
            dropShadow: {
                enabled: true,
                top: 10,
                left: 0,
                bottom: 0,
                right: 0,
                blur: 2,
                color: '#45404a2e',
                opacity: 0.15
            },
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '85%'
                }
            }
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [
            <?php
            foreach ($browser as $show) {
                echo ceil($show->jml) . ",";
            }
            ?>
        ],
        legend: {
            show: false,
            position: 'bottom',
            horizontalAlign: 'center',
            verticalAlign: 'middle',
            floating: false,
            fontSize: '14px',
            offsetX: 0,
            offsetY: -13
        },
        labels: [
            <?php
            foreach ($browser as $show) {
                echo '"' . $show->pengunjung_browser . '",';
            }
            ?>
        ],
        colors: ["#34bfa3", "#5d78ff", "#ff9f43", "#fd3c97", "#4B0082", "#000000", "#FF4500"],

        responsive: [{
            breakpoint: 600,
            options: {
                plotOptions: {
                    donut: {
                        customScale: 0.2
                    }
                },
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                },
            }
        }],

        tooltip: {
            y: {
                formatter: function(val) {
                    return val + "%"
                }
            }
        }

    }

    var chart = new ApexCharts(
        document.querySelector("#ana_device"),
        options
    );

    chart.render();
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
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-3">
                    <a href="<?= base_url('nimda/berita') ?>">
                        <div class="card dash-data-card text-center">
                            <div class="card-body">
                                <div class="icon-info mb-3">
                                    <i class="far fa-newspaper bg-soft-warning"></i>
                                </div>
                                <h3 class="text-dark"><?= $jmlberita->berita_detail_id ?></h3>
                                <h6 class="font-14 text-dark">Berita</h6>
                            </div>
                            <!--end card-body-->
                        </div>
                    </a>
                    <!--end card-->
                </div><!-- end col-->
                <div class="col-lg-3">
                    <a href="<?= base_url('nimda/pidato') ?>">
                        <div class="card dash-data-card text-center">
                            <div class="card-body">
                                <div class="icon-info mb-3">
                                    <i class="far fa-images bg-soft-pink"></i>
                                </div>
                                <h3 class="text-dark"><?= $jmlpidato->pidato_detail_id ?></h3>
                                <h6 class="font-14 text-dark">Pidato</h6>
                            </div>
                            <!--end card-body-->
                        </div>
                    </a>
                    <!--end card-->
                </div><!-- end col-->
                <div class="col-lg-3">
                    <a href="<?= base_url('nimda/agenda') ?>">
                        <div class="card dash-data-card text-center">
                            <div class="card-body">
                                <div class="icon-info mb-3">
                                    <i class="fas fa-info bg-soft-success"></i>
                                </div>
                                <h3 class="text-dark"><?= $jmlagenda->agenda_id ?></h3>
                                <h6 class="font-14 text-dark">Agenda</h6>
                            </div>
                            <!--end card-body-->
                        </div>
                    </a>
                    <!--end card-->
                </div><!-- end col-->
                <div class="col-lg-3">
                    <a href="<?= base_url('nimda/slider') ?>">
                        <div class="card dash-data-card text-center">
                            <div class="card-body">
                                <div class="icon-info mb-3">
                                    <i class="ti-layers-alt bg-soft-primary"></i>
                                </div>
                                <h3 class="text-dark"><?= $jmlslider->slider_id ?></h3>
                                <h6 class="font-14 text-dark">Slider</h6>
                            </div>
                            <!--end card-body-->
                        </div>
                    </a>
                    <!--end card-->
                </div><!-- end col-->
            </div>
            <!--end row-->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Statistik Pengguna</h4>
                    <div class="">
                        <div id="ana_dash_1" class="apex-charts"></div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Statistik Browser</h4>
                    <div class="happiness-score">
                        <h2 class="mb-1">BROWSER</h2>
                        <p class="mb-0 text-uppercase">&nbsp;</p>
                    </div>
                    <div id="ana_device" class="apex-charts mt-4"></div>
                    <div class="table-responsive">
                        <table class="table border-dashed mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-bottom-0">OS</th>
                                    <th class="border-bottom-0 text-right">List</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-dark" scope="row"><i class="fab fa-windows text-primary font-24 mr-2 align-middle"></i>Windows 10</th>
                                    <td class="text-right"><?= $w10 ?>%</td>
                                </tr>
                                <tr>
                                    <th class="text-dark" scope="row"><i class="fab fa-windows text-primary font-24 mr-2 align-middle"></i>Windows 8</th>
                                    <td class="text-right"><?= $w8 ?>%</td>
                                </tr>
                                <tr>
                                    <th class="text-dark" scope="row"><i class="fab fa-apple text-info font-24 mr-2 align-middle"></i>Mac OS</th>
                                    <td class="text-right"><?= $mac ?>%</td>
                                </tr>
                                <tr>
                                    <th class="text-dark" scope="row"><i class="fab fa-android text-success font-24 mr-2 align-middle"></i>Android</th>
                                    <td class="text-right"><?= $android ?>%</td>
                                </tr>
                                <tr>
                                    <th class="text-dark" scope="row"><i class="fas fa-bullseye text-dark font-24 mr-2 align-middle"></i>Lainya</th>
                                    <td class="text-right"><?= $other ?>%</td>
                                </tr>

                            </tbody>
                        </table>
                        <!--end /table-->
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Agenda Terbaru</h4>
                    <div class="table-responsive browser_users">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0" width="5%">No</th>
                                    <th class="border-top-0">Judul</th>
                                    <th class="border-top-0">Tanggal</th>
                                    <th class="border-top-0">Jam</th>
                                    <th class="border-top-0">Lokasi</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                <?php

                                $nomor = 1;
                                foreach ($agenda as $u) :
                                ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $u->agenda_judul ?></td>
                                        <td><?= $u->agenda_tanggal ?></td>
                                        <td><?= $u->agenda_jam ?></td>
                                        <td><?= $u->agenda_lokasi ?></td>

                                    </tr>
                                <?php endforeach; ?>
                                <!--end tr-->

                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <!--crypot dash activity-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <!--p class="badge badge-soft-pink font-11 p-1 mb-1 float-lg-right float-md-none">Last updated 15 minutes ago</p-->
                    <h4 class="header-title mt-0 mb-3">Berita Terbaru</h4>
                    <div class="table-responsive browser_users">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0" width="5%">No</th>
                                    <th class="border-top-0">Judul</th>
                                    <th class="border-top-0">Kategori</th>
                                    <th class="border-top-0">Dilihat</th>
                                    <th class="border-top-0">Tgl Update</th>
                                </tr>
                                <!--end tr-->
                            </thead>
                            <tbody>
                                <?php

                                $nomor = 1;
                                foreach ($berita as $u) :
                                ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $u->berita_detail_judul ?></td>
                                        <td><?= $u->berita_judul ?></td>
                                        <td><?= $u->berita_detail_dibaca ?></td>
                                        <td><?= $u->updated_at ?></td>

                                    </tr>
                                <?php endforeach; ?>
                                <!--end tr-->

                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                    <!--end /div-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <!--end row-->

    <!--end row-->

</div><!-- container -->
<?= $this->endSection() ?>