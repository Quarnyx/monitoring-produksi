<?php
require_once __DIR__ . '/../../config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah':
        $kode_produksi = $_POST['kode_produksi'];
        $tanggal = $_POST['tanggal'];
        $jumlah_bagus = $_POST['jumlah_bagus'];
        $jumlah_reject = $_POST['jumlah_reject'];
        $catatan = $_POST['catatan'];
        
        $sql = "INSERT INTO hasil_produksi (kode_produksi, tanggal, jumlah_bagus, jumlah_reject, catatan) VALUES ('$kode_produksi', '$tanggal', '$jumlah_bagus', '$jumlah_reject', '$catatan')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Hasil Produksi Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit':
        $kode_produksi = $_POST['kode_produksi'];
        $tanggal = $_POST['tanggal'];
        $jumlah_bagus = $_POST['jumlah_bagus'];
        $jumlah_reject = $_POST['jumlah_reject'];
        $catatan = $_POST['catatan'];
        $id = $_POST['id'];
        
        $sql = "UPDATE hasil_produksi SET kode_produksi = '$kode_produksi', tanggal = '$tanggal', jumlah_bagus = '$jumlah_bagus', jumlah_reject = '$jumlah_reject', catatan = '$catatan' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Hasil Produksi Berhasil Diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = "DELETE FROM hasil_produksi WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Hasil Produksi Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
}
