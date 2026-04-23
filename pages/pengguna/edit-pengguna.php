<?php
require_once '../../config.php';
$sql = "SELECT * FROM pengguna WHERE id = '$_POST[id]'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-pengguna" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama</label>
                <input type="text" id="simpleinput" class="form-control" name="nama" value="<?= $row['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username"
                    value="<?= $row['username'] ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Level</label>
                <select name="level" class="form-select" required>
                    <option value="admin" <?= $row['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="qc" <?= $row['level'] == 'qc' ? 'selected' : '' ?>>QC</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $("#edit-pengguna").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'pages/pengguna/proses.php?aksi=edit',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Pengguna Berhasil DIubah');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>