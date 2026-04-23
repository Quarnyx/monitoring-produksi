<form id="tambah-hasil" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="kode_produksi" class="form-label">Kode Produksi</label>
                <input type="text" id="kode_produksi" class="form-control" name="kode_produksi" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_bagus" class="form-label">Jumlah Bagus</label>
                <input type="number" id="jumlah_bagus" name="jumlah_bagus" class="form-control" placeholder="Jumlah Bagus" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" class="form-control" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_reject" class="form-label">Jumlah Reject</label>
                <input type="number" id="jumlah_reject" name="jumlah_reject" class="form-control" placeholder="Jumlah Reject" required>
            </div>
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea id="catatan" name="catatan" class="form-control" placeholder="Catatan"></textarea>
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
    $("#tambah-hasil").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'pages/rekam_produksi/proses.php?aksi=tambah',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    loadTable();
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
