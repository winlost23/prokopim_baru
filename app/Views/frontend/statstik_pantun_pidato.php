<?= $this->extend('frontend/master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($judul) ?>,
            datasets: [{
                label: 'Total',
                data: <?= json_encode($jml) ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(44, 175, 254, 0.2)',
                    'rgba(254, 106, 53, 0.2)',
                    'rgba(84, 79, 197, 0.2)',
                    'rgba(255, 206, 131, 0.2)',
                    'rgba(71, 249, 227, 0.2)',
                    'rgba(145, 232, 225, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(44, 175, 254, 1)',
                    'rgba(254, 106, 53, 1)',
                    'rgba(84, 79, 197, 1)',
                    'rgba(255, 206, 131, 1)',
                    'rgba(71, 249, 227, 1)',
                    'rgba(145, 232, 225, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- block-wrapper-section
================================================== -->
<section class="block-wrapper left-sidebar">
    <div class="container">
        <!-- block content -->
        <div class="block-content non-sidebar">

            <!-- grid box -->
            <div class="grid-box">
                <div class="title-section">
                    <h1><span class="world">Statistik Pantun Pidato</span></h1>
                </div>
                <div class="row">
                    <canvas id="barChart" width="400" height="200"></canvas>
                </div>
            </div>
            <!-- End grid box -->

        </div>
        <!-- End block content -->

    </div>
</section>

<?= $this->endSection() ?>