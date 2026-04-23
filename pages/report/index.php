<?php
require_once __DIR__ . '/../../config.php';

$start_date = $_GET['start_date'] ?? date('Y-m-01');
$end_date = $_GET['end_date'] ?? date('Y-m-t');

// Pie Chart data
$pie_query = mysqli_query($link, "SELECT SUM(jumlah_bagus) as total_bagus, SUM(jumlah_reject) as total_reject FROM hasil_produksi WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
$pie_data = mysqli_fetch_assoc($pie_query);
$total_bagus = $pie_data['total_bagus'] ?? 0;
$total_reject = $pie_data['total_reject'] ?? 0;

// Trend Chart data
$trend_query = mysqli_query($link, "SELECT tanggal, SUM(jumlah_bagus) as bagus, SUM(jumlah_reject) as reject FROM hasil_produksi WHERE tanggal BETWEEN '$start_date' AND '$end_date' GROUP BY tanggal ORDER BY tanggal ASC");
$trend_dates = [];
$trend_bagus = [];
$trend_reject = [];
while ($row = mysqli_fetch_assoc($trend_query)) {
    $trend_dates[] = $row['tanggal'];
    $trend_bagus[] = $row['bagus'];
    $trend_reject[] = $row['reject'];
}

// Bar Chart data
$bar_query = mysqli_query($link, "
    SELECT k.kategori_defect, SUM(d.jumlah) as total 
    FROM detail_produksi_defect d 
    JOIN hasil_produksi h ON d.hasil_produksi_id = h.id 
    JOIN kategori_defect k ON d.kategori_defect_id = k.id 
    WHERE h.tanggal BETWEEN '$start_date' AND '$end_date' 
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
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="mb-0">Laporan Produksi</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Monitor Produksi</a></li>
                <li class="breadcrumb-item active">Laporan Produksi</li>
            </ol>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="GET" class="row align-items-center">
                    <input type="hidden" name="page" value="laporan-produksi">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="<?= $start_date ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control" value="<?= $end_date ?>" required>
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="ri-search-line"></i> Filter
                            Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Total Bagus vs Reject</h4>
                <div id="pie-chart" class="apex-charts"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Trend Produksi Harian</h4>
                <div id="trend-chart" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Total Defect per Kategori</h4>
                <div id="bar-chart" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Data Rekam Produksi</h4>
                <table id="tabel-laporan" class="table table-bordered table-bordered dt-responsive nowrap">
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
                        $query = mysqli_query($link, "SELECT * FROM hasil_produksi WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
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
        $('#tabel-laporan').DataTable();

        // Pie Chart
        var pieOptions = {
            series: [<?= $total_bagus ?>, <?= $total_reject ?>],
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
        var pieChart = new ApexCharts(document.querySelector("#pie-chart"), pieOptions);
        pieChart.render();

        // Trend Chart
        var trendOptions = {
            series: [{
                name: 'Jumlah Bagus',
                data: <?= json_encode($trend_bagus) ?>
            }, {
                name: 'Jumlah Reject',
                data: <?= json_encode($trend_reject) ?>
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
                categories: <?= json_encode($trend_dates) ?>,
            },
        };
        var trendChart = new ApexCharts(document.querySelector("#trend-chart"), trendOptions);
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
            },
        };
        var barChart = new ApexCharts(document.querySelector("#bar-chart"), barOptions);
        barChart.render();
    });
</script>