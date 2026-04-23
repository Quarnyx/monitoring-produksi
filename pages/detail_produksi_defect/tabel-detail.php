<?php
$hasil_produksi_id = $_GET['id'] ?? 0;
?>

<table id="tabel-data-detail" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Produk</th>
            <th>Kategori Defect</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../config.php';
        $no = 0;
        session_start();
        $query = mysqli_query($link, "
            SELECT d.*, p.nama_produk, k.kategori_defect 
            FROM detail_produksi_defect d 
            LEFT JOIN produk p ON d.produk_id = p.id 
            LEFT JOIN kategori_defect k ON d.kategori_defect_id = k.id
            WHERE d.hasil_produksi_id = '$hasil_produksi_id'
        ");
        if ($query) {
            while ($data = mysqli_fetch_array($query)) {
                $no++;
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['nama_produk'] ?></td>
                    <td><?= $data['kategori_defect'] ?></td>
                    <td><?= $data['jumlah'] ?></td>
                    <td><?= $data['keterangan'] ?></td>
                    <td>
                        <button data-id="<?= $data['id'] ?>" data-name="Detail Defect" id="edit" type="button"
                            class="btn btn-primary">Edit</button>
                        <button data-id="<?= $data['id'] ?>" data-name="Detail Defect" id="delete" type="button"
                            class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<div class="mt-3">
    <p class="text-end fs-5">TOTAL PRODUK: <?php
    $total = 0;
    $query = mysqli_query($link, "SELECT jumlah FROM detail_produksi_defect WHERE hasil_produksi_id = '$hasil_produksi_id'");
    while ($data = mysqli_fetch_array($query)) {
        $total += $data['jumlah'];
    }
    echo $total;
    ?></p>
</div>
<script>
    $(document).ready(function () {
        $('#tabel-data-detail').DataTable();
        $('#tabel-data-detail').on('click', '#edit', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            $.ajax({
                type: 'POST',
                url: 'pages/detail_produksi_defect/edit-detail.php',
                data: 'id=' + id + '&name=' + name,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });

        $('#tabel-data-detail').on('click', '#delete', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ini?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/detail_produksi_defect/proses.php?aksi=hapus',
                    data: 'id=' + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'success') {
                            loadTableDetail();
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