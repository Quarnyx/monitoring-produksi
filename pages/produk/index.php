<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="mb-0">Data Produk</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Monitor Produksi</a></li>
                <li class="breadcrumb-item active">Data Produk</li>
            </ol>
        </div>

        <button class="btn btn-success" id="tambah">
            <i class="ri-add-fill"></i> Tambah
        </button>
    </div>
</div>
<!-- end row-->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Produk</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('pages/produk/tabel-produk.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Produk');
            // load form
            $('.modal-body').load('pages/produk/tambah-produk.php');
        });
    });
</script>
