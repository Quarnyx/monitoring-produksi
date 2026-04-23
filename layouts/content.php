<?php

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'dashboard':
        include 'pages/dashboard.php';
        break;
    case 'data-pengguna':
        include 'pages/pengguna/index.php';
        break;
    case 'data-produk':
        include 'pages/produk/index.php';
        break;
    case 'kategori-defect-produk':
        include 'pages/kategori_defect_produk/index.php';
        break;
    case 'rekam-produksi':
        include 'pages/rekam_produksi/index.php';
        break;
    case 'detail-rekam-produksi':
        include 'pages/detail_produksi_defect/index.php';
        break;
    case 'laporan-produksi':
        include 'pages/report/index.php';
        break;
    default:
        include 'pages/dashboard.php';
        break;
}