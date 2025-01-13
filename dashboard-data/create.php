<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $usia = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $pekerjaan = $_POST['pekerjaan'];

    // Query untuk memasukkan data
    $query = "INSERT INTO penduduk (nama, alamat, usia, jenis_kelamin, status_perkawinan, pekerjaan) 
              VALUES (:nama, :alamat, :usia, :jenis_kelamin, :status_perkawinan, :pekerjaan)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':usia', $usia);
    $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
    $stmt->bindParam(':status_perkawinan', $status_perkawinan);
    $stmt->bindParam(':pekerjaan', $pekerjaan);

    if ($stmt->execute()) {
        // Redirect ke index.php setelah berhasil
        header('Location: index.php');
        exit;
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>
