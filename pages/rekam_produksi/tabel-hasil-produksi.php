<table id="tabel-data-hasil" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Produksi</th>
            <th>Tanggal</th>
            <th>Jumlah Bagus</th>
            <th>Jumlah Reject</th>
            <th>Total Produksi</th>
            <th>Catatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../config.php';
        $no = 0;
        session_start();
        $query = mysqli_query($link, "SELECT * FROM hasil_produksi");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            $jumlah_bagus = $data['jumlah_bagus'] ?? 0;
            $jumlah_reject = $data['jumlah_reject'] ?? 0;
            $total = $jumlah_bagus + $jumlah_reject;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['kode_produksi'] ?></td>
                <td><?= $data['tanggal'] ?></td>
                <td class="text-center"><?= $jumlah_bagus ?></td>
                <td class="text-center"><?= $jumlah_reject ?></td>
                <td class="text-center">
                    <?= $total ?>
                    <div class="progress" role="progressbar" aria-label="progress_<?= $data['id'] ?>"
                        aria-valuenow="<?= $total ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: <?= ($jumlah_bagus / $total) * 100 ?>%">
                            <?= $jumlah_bagus ?>
                        </div>
                        <div class="progress-bar bg-danger" style="width: <?= ($jumlah_reject / $total) * 100 ?>%">
                            <?= $jumlah_reject ?>
                        </div>
                    </div>
                </td>
                <td><?= $data['catatan'] ?></td>
                <td>
                    <a href="?page=detail-rekam-produksi&id=<?= $data['id'] ?>" class="btn btn-info">Detail Defect</a>
                    <button data-id="<?= $data['id'] ?>" data-name="<?= $data['kode_produksi'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id'] ?>" data-name="<?= $data['kode_produksi'] ?>" id="delete" type="button"
                        class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#tabel-data-hasil').DataTable();
        $('#tabel-data-hasil').on('click', '#edit', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            $.ajax({
                type: 'POST',
                url: 'pages/rekam_produksi/edit-hasil-produksi.php',
                data: 'id=' + id + '&name=' + name,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });

        $('#tabel-data-hasil').on('click', '#delete', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/rekam_produksi/proses.php?aksi=hapus',
                    data: 'id=' + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'success') {
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
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });
    });
</script>