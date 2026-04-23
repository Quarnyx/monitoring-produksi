<?php
require_once '../../config.php';
$sql = "SELECT * FROM produk WHERE id = '$_POST[id]'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-produk" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" id="nama_produk" class="form-control" name="nama_produk" value="<?= $row['nama_produk'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="kode_produk" class="form-label">Kode Produk</label>
                <input type="text" id="kode_produk" name="kode_produk" class="form-control" placeholder="Kode Produk"
                    value="<?= $row['kode_produk'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="variasi_produk" class="form-label">Variasi Produk</label>
                <input type="text" id="variasi_produk" name="variasi_produk" class="form-control" placeholder="Variasi Produk"
                    value="<?= $row['variasi_produk'] ?>" required>
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
    $("#edit-produk").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'pages/produk/proses.php?aksi=edit',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    $(".modal").modal('hide');
                    loadTable();
                    alertify.success(data.message);
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
