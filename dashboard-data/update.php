<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $usia = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $pekerjaan = $_POST['pekerjaan'];

    // Validasi data
    if (empty($nama) || empty($alamat) || empty($usia) || empty($jenis_kelamin) || empty($status_perkawinan) || empty($pekerjaan)) {
        echo "Semua kolom wajib diisi.";
        exit;
    }

    // Query untuk update data
    $stmt = $conn->prepare("UPDATE penduduk SET nama = ?, alamat = ?, usia = ?, jenis_kelamin = ?, status_perkawinan = ?, pekerjaan = ? WHERE id = ?");
    $stmt->bind_param("ssisssi", $nama, $alamat, $usia, $jenis_kelamin, $status_perkawinan, $pekerjaan, $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman index dengan pesan sukses
        header("Location: index.php?success=Data berhasil diperbarui");
        exit;
    } else {
        // Jika gagal, tampilkan error
        echo "Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
