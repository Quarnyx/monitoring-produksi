<?php
require_once __DIR__ . '/../../config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah':
        $nama_produk = $_POST['nama_produk'];
        $kode_produk = $_POST['kode_produk'];
        $variasi_produk = $_POST['variasi_produk'];
        
        $sql = "INSERT INTO produk (nama_produk, kode_produk, variasi_produk) VALUES ('$nama_produk', '$kode_produk', '$variasi_produk')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Produk Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit':
        $nama_produk = $_POST['nama_produk'];
        $kode_produk = $_POST['kode_produk'];
        $variasi_produk = $_POST['variasi_produk'];
        $id = $_POST['id'];
        
        $sql = "UPDATE produk SET nama_produk = '$nama_produk', kode_produk = '$kode_produk', variasi_produk = '$variasi_produk' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Produk Berhasil Diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = "DELETE FROM produk WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Produk Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
}
