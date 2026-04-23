<?php
require_once __DIR__ . '/../../config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah':
        $kategori_defect = $_POST['kategori_defect'];
        
        $sql = "INSERT INTO kategori_defect (kategori_defect) VALUES ('$kategori_defect')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Kategori Defect Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit':
        $kategori_defect = $_POST['kategori_defect'];
        $id = $_POST['id'];
        
        $sql = "UPDATE kategori_defect SET kategori_defect = '$kategori_defect' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Kategori Defect Berhasil Diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = "DELETE FROM kategori_defect WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Kategori Defect Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
}
