<?php
require_once '../../config.php';
$sql = "SELECT * FROM kategori_defect WHERE id = '$_POST[id]'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-kategori" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="kategori_defect" class="form-label">Kategori Defect</label>
                <input type="text" id="kategori_defect" class="form-control" name="kategori_defect" value="<?= $row['kategori_defect'] ?>" required>
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
    $("#edit-kategori").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'pages/kategori_defect_produk/proses.php?aksi=edit',
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
