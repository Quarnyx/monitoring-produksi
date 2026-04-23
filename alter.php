<?php
require_once 'config.php';
$sql = "ALTER TABLE hasil_produksi ADD COLUMN tanggal DATE NULL";
if (mysqli_query($link, $sql)) {
    echo "Success";
} else {
    echo "Error: " . mysqli_error($link);
}
?>
