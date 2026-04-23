<?php
require_once __DIR__ . '/../../config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah':
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO pengguna (username, password, nama) VALUES ('$username', '$password', '$nama')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Pengguna Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit':
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $id = $_POST['id'];
        $sql = "UPDATE pengguna SET username = '$username', nama = '$nama' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Pengguna Berhasil Diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }

        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = "DELETE FROM pengguna WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Pengguna Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'ganti-password':
        $password = md5($_POST['password']);
        $id = $_POST['id'];
        $sql = "UPDATE pengguna SET password = '$password' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Password Berhasil Diperbarui']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
}