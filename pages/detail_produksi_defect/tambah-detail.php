<?php
require_once '../../config.php';
$hasil_produksi_id = $_GET['hasil_produksi_id'] ?? 0;

$produk_query = mysqli_query($link, "SELECT * FROM produk");
$kategori_query = mysqli_query($link, "SELECT * FROM kategori_defect");
?>
<form id="form-tambah-detail" enctype="multipart/form-data">
    <input type="hidden" name="hasil_produksi_id" value="<?= $hasil_produksi_id ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="produk_id" class="form-label">Produk</label>
                <select name="produk_id" id="produk_id" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    <?php while ($p = mysqli_fetch_array($produk_query)): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nama_produk'] ?> (<?= $p['kode_produk'] ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="kategori_defect_id" class="form-label">Kategori Defect</label>
                <select name="kategori_defect_id" id="kategori_defect_id" class="form-control" required>
                    <option value="">Pilih Kategori Defect</option>
                    <?php while ($k = mysqli_fetch_array($kategori_query)): ?>
                        <option value="<?= $k['id'] ?>"><?= $k['kategori_defect'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        var choicesIdProduk = new Choices('#produk_id', {
            searchEnabled: true,
            placeholderValue: 'Pilih Produk',
            searchPlaceholderValue: 'Cari produk...',
            itemSelectText: 'Pilih',
            noResultsText: 'Tidak ditemukan',
        });
        var choicesKategoriDefect = new Choices('#kategori_defect_id', {
            searchEnabled: true,
            placeholderValue: 'Pilih Kategori Defect',
            searchPlaceholderValue: 'Cari kategori defect...',
            itemSelectText: 'Pilih',
            noResultsText: 'Tidak ditemukan',
        });
    })
    $("#form-tambah-detail").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'pages/detail_produksi_defect/proses.php?aksi=tambah',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    loadTableDetail();
                    alertify.success(data.message);
                    $('.modal').modal('hide');
                } else {
                    alertify.error(data.message);
                }
            },
            error: function (xhr) {
                var errorMessage = 'Terjadi kesalahan sistem';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.message) errorMessage = response.message;
                    } catch (e) {
                        errorMessage = xhr.responseText;
                    }
                }
                alertify.error(errorMessage);
            }
        });
    });
</script>