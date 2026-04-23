<?php
require_once __DIR__ . '/../../config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah':
        $hasil_produksi_id = $_POST['hasil_produksi_id'];
        $produk_id = $_POST['produk_id'];
        $kategori_defect_id = $_POST['kategori_defect_id'];
        $jumlah = $_POST['jumlah'];
        $keterangan = $_POST['keterangan'];
        
        $sql = "INSERT INTO detail_produksi_defect (hasil_produksi_id, produk_id, kategori_defect_id, jumlah, keterangan) VALUES ('$hasil_produksi_id', '$produk_id', '$kategori_defect_id', '$jumlah', '$keterangan')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Detail Defect Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit':
        $produk_id = $_POST['produk_id'];
        $kategori_defect_id = $_POST['kategori_defect_id'];
        $jumlah = $_POST['jumlah'];
        $keterangan = $_POST['keterangan'];
        $id = $_POST['id'];
        
        $sql = "UPDATE detail_produksi_defect SET produk_id = '$produk_id', kategori_defect_id = '$kategori_defect_id', jumlah = '$jumlah', keterangan = '$keterangan' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Detail Defect Berhasil Diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = "DELETE FROM detail_produksi_defect WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Detail Defect Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
}
