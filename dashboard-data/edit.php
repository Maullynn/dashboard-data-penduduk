<?php
require_once 'db.php';

// Validasi parameter ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

try {
    // Ambil data berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM penduduk WHERE id = ?");
    $stmt->execute([$id]);
    $penduduk = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika data tidak ditemukan, redirect ke halaman index
    if (!$penduduk) {
        header("Location: index.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $usia = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $pekerjaan = $_POST['pekerjaan'];

    // Validasi jenis kelamin dan status perkawinan
    if (empty($jenis_kelamin) || empty($status_perkawinan) || empty($pekerjaan)) {
        $error = "Semua kolom harus diisi.";
    } else {
        try {
            // Update data ke database
            $sql = "UPDATE penduduk SET nama = ?, alamat = ?, usia = ?, jenis_kelamin = ?, status_perkawinan = ?, pekerjaan = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nama, $alamat, $usia, $jenis_kelamin, $status_perkawinan, $pekerjaan, $id]);

            // Redirect dengan pesan sukses
            header("Location: index.php?status=success&message=Data berhasil diperbarui");
            exit();
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f39c12, #f1c40f);
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2rem;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2rem;
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Data Penduduk</h3>
                </div>
                <div class="card-body">
                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                   value="<?php echo htmlspecialchars($penduduk['nama']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($penduduk['alamat']); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia</label>
                            <input type="number" class="form-control" id="usia" name="usia"
                                   value="<?php echo htmlspecialchars($penduduk['usia']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?php echo ($penduduk['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="P" <?php echo ($penduduk['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                                <option value="">Pilih Status Perkawinan</option>
                                <option value="Belum Menikah" <?php echo ($penduduk['status_perkawinan'] == 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
                                <option value="Menikah" <?php echo ($penduduk['status_perkawinan'] == 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
                                <option value="Janda/Duda" <?php echo ($penduduk['status_perkawinan'] == 'Janda/Duda') ? 'selected' : ''; ?>>Janda/Duda</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                   value="<?php echo htmlspecialchars($penduduk['pekerjaan']); ?>" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
