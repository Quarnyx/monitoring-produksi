<!-- ========== Page Title Start ========== -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="mb-0">Monitoring Produksi</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- ========== Page Title End ========== -->
<?php
require_once __DIR__ . '/../config.php';

$today = date('Y-m-d');

// Insight 1: Total Produksi Hari Ini
$q_produksi = mysqli_query($link, "SELECT SUM(jumlah_bagus) + SUM(jumlah_reject) as total FROM hasil_produksi WHERE tanggal = '$today'");
$r_produksi = mysqli_fetch_assoc($q_produksi);
$total_produksi = $r_produksi['total'] ?? 0;

// Insight 2: Total Bagus Hari Ini
$q_bagus = mysqli_query($link, "SELECT SUM(jumlah_bagus) as total FROM hasil_produksi WHERE tanggal = '$today'");
$r_bagus = mysqli_fetch_assoc($q_bagus);
$total_bagus = $r_bagus['total'] ?? 0;

// Insight 3: Total Reject Hari Ini
$q_reject = mysqli_query($link, "SELECT SUM(jumlah_reject) as total FROM hasil_produksi WHERE tanggal = '$today'");
$r_reject = mysqli_fetch_assoc($q_reject);
$total_reject = $r_reject['total'] ?? 0;

// Insight 4: Total Defect Tercatat Hari Ini
$q_defect = mysqli_query($link, "
    SELECT SUM(d.jumlah) as total 
    FROM detail_produksi_defect d
    JOIN hasil_produksi h ON d.hasil_produksi_id = h.id
    WHERE h.tanggal = '$today'
");
$r_defect = mysqli_fetch_assoc($q_defect);
$total_defect = $r_defect['total'] ?? 0;

// --- CHART DATA FOR TODAY ---

// Pie Chart data
$pie_query = mysqli_query($link, "SELECT SUM(jumlah_bagus) as total_bagus, SUM(jumlah_reject) as total_reject FROM hasil_produksi WHERE tanggal = '$today'");
$pie_data = mysqli_fetch_assoc($pie_query);
$chart_bagus = $pie_data['total_bagus'] ?? 0;
$chart_reject = $pie_data['total_reject'] ?? 0;

// Trend Chart data (Trend Produksi per Kode Produksi for today)
$trend_query = mysqli_query($link, "SELECT kode_produksi, jumlah_bagus, jumlah_reject FROM hasil_produksi WHERE tanggal = '$today' ORDER BY id ASC");
$trend_categories = [];
$trend_bagus_data = [];
$trend_reject_data = [];
while ($row = mysqli_fetch_assoc($trend_query)) {
    $trend_categories[] = $row['kode_produksi'];
    $trend_bagus_data[] = $row['jumlah_bagus'];
    $trend_reject_data[] = $row['jumlah_reject'];
}

// Bar Chart data (Defect per Kategori for today)
$bar_query = mysqli_query($link, "
    SELECT k.kategori_defect, SUM(d.jumlah) as total 
    FROM detail_produksi_defect d 
    JOIN hasil_produksi h ON d.hasil_produksi_id = h.id 
    JOIN kategori_defect k ON d.kategori_defect_id = k.id 
    WHERE h.tanggal = '$today' 
    GROUP BY k.id
");
$bar_categories = [];
$bar_series = [];
while ($row = mysqli_fetch_assoc($bar_query)) {
    $bar_categories[] = $row['kategori_defect'];
    $bar_series[] = $row['total'];
}
?>
<div class="row">
    <!-- Card 1 -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-primary bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:globus-outline"
                                class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Total Produksi</p>
                        <h3 class="text-dark mt-2 mb-0"><?= $total_produksi; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted ms-1 fs-12">Total Unit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-success bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:check-circle-outline"
                                class="fs-32 text-success avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Good</p>
                        <h3 class="text-dark mt-2 mb-0"><?= $total_bagus; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted ms-1 fs-12">Total Produk Bagus</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-danger bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:close-circle-outline"
                                class="fs-32 text-danger avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Not Good</p>
                        <h3 class="text-dark mt-2 mb-0"><?= $total_reject; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted ms-1 fs-12">Total Produk Reject</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-md bg-warning bg-opacity-10 rounded-circle">
                            <iconify-icon icon="solar:danger-triangle-outline"
                                class="fs-32 text-warning avatar-title"></iconify-icon>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="text-muted mb-0 text-truncate">Defect</p>
                        <h3 class="text-dark mt-2 mb-0"><?= $total_defect; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 py-2 bg-light bg-opacity-50 mx-2 mb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted ms-1 fs-12">Total Defect Tercatat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Good vs Not Good</h4>
                <div id="pie-chart-today" class="apex-charts"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Trend Produksi per Kode Produksi (Hari Ini)</h4>
                <div id="trend-chart-today" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Total Defect per Kategori (Hari Ini)</h4>
                <div id="bar-chart-today" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Data Rekam Produksi (Hari Ini)</h4>
                <table id="tabel-laporan-hari-ini" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Produksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah Bagus</th>
                            <th>Jumlah Reject</th>
                            <th>Total Produksi</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($link, "SELECT * FROM hasil_produksi WHERE tanggal = '$today'");
                        while ($data = mysqli_fetch_array($query)) {
                            $no++;
                            $bagus = $data['jumlah_bagus'] ?? 0;
                            $reject = $data['jumlah_reject'] ?? 0;
                            $total = $bagus + $reject;
                            ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data['kode_produksi'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td class="text-center"><?= $bagus ?></td>
                                <td class="text-center"><?= $reject ?></td>
                                <td class="text-center"><?= $total ?></td>
                                <td class="truncate"><?= $data['catatan'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tabel-laporan-hari-ini').DataTable();

        // Pie Chart
        var pieOptions = {
            series: [<?= $chart_bagus ?>, <?= $chart_reject ?>],
            chart: {
                type: 'pie',
                height: 350
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
            },
            labels: ['Jumlah Bagus', 'Jumlah Reject'],
            colors: ['#28a745', '#dc3545'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                }
            }]
        };
        var pieChart = new ApexCharts(document.querySelector("#pie-chart-today"), pieOptions);
        pieChart.render();

        // Trend Chart (Area based on Kode Produksi)
        var trendOptions = {
            series: [{
                name: 'Jumlah Bagus',
                data: <?= json_encode($trend_bagus_data) ?>
            }, {
                name: 'Jumlah Reject',
                data: <?= json_encode($trend_reject_data) ?>
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            colors: ['#28a745', '#dc3545'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: <?= json_encode($trend_categories) ?>,
            },
        };
        var trendChart = new ApexCharts(document.querySelector("#trend-chart-today"), trendOptions);
        trendChart.render();

        // Bar Chart
        var barOptions = {
            series: [{
                name: 'Total Defect',
                data: <?= json_encode($bar_series) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            colors: ['#ffc107'],
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: <?= json_encode($bar_categories) ?>,
            }
        };
        var barChart = new ApexCharts(document.querySelector("#bar-chart-today"), barOptions);
        barChart.render();
    });
</script>