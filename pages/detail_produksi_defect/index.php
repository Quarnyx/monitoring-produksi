<?php
$hasil_produksi_id = $_GET['id'] ?? 0;
require_once __DIR__ . '/../../config.php';
$data = mysqli_query($link, "SELECT * FROM hasil_produksi WHERE id = '$hasil_produksi_id'");
$data = mysqli_fetch_assoc($data);
$kode_produksi = $data['kode_produksi'];
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="mb-0">Detail Produksi Defect - <?= $kode_produksi ?></h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Monitor Produksi</a></li>
                <li class="breadcrumb-item"><a href="?page=rekam-produksi">Rekam Produksi</a></li>
                <li class="breadcrumb-item active">Detail Defect</li>
            </ol>
        </div>

        <button class="btn btn-success" id="tambah-detail">
            <i class="ri-add-fill"></i> Tambah Detail
        </button>
        <a href="?page=rekam-produksi" class="btn btn-secondary">
            <i class="ri-arrow-left-line"></i> Kembali
        </a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Informasi Produksi</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Kode Produksi:</strong>
                            <?= $kode_produksi ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal:</strong>
                            <?= $data['tanggal'] ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Jumlah Bagus:</strong>
                            <?= $data['jumlah_bagus'] ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Jumlah Reject:</strong>
                            <?= $data['jumlah_reject'] ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Produksi:</strong>
                            <?= $data['jumlah_bagus'] + $data['jumlah_reject'] ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Catatan:</strong>
                            <?= $data['catatan'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row-->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Detail Defect</h4>
                <div id="load-table-detail">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    const hasil_produksi_id = <?= $hasil_produksi_id ?>;
    function loadTableDetail() {
        $('#load-table-detail').load('pages/detail_produksi_defect/tabel-detail.php?id=' + hasil_produksi_id)
    }
    $(document).ready(function () {
        loadTableDetail();
        $('#tambah-detail').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Detail Defect');
            // load form
            $('.modal-body').load('pages/detail_produksi_defect/tambah-detail.php?hasil_produksi_id=' + hasil_produksi_id);
        });
    });
</script>