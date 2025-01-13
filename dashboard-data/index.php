<?php
include 'db.php'; 

// Ambil data penduduk
$query = "SELECT * FROM penduduk";
$stmt = $pdo->prepare($query);
$stmt->execute();
$pendudukData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Penduduk RT 011</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-color: #f8f9fa;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }

        .header-title {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header-title h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 1rem 1.5rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--primary-color);
            font-weight: bold; 
        }

        .btn-add {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white; 
            border: none; 
            padding: .5rem; 
            border-radius: .25rem; 
            font-weight: bold; 
            transition: all .3s ease; 
        }
        
        .btn-add:hover { 
            transform: translateY(-2px); 
            box-shadow: 0px 4px 10px rgba(46, 204, 113, .4); 
        }
        
        .btn-edit { 
            background: linear-gradient(135deg, #f39c12, #f1c40f); 
            color: white; 
            border: none; 
            padding: .5rem; 
            border-radius: .25rem; 
        }
        
        .btn-delete { 
            background: linear-gradient(135deg, #c0392b, #e74c3c); 
            color: white; 
            border: none; 
            padding: .5rem; 
            border-radius: .25rem; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-city me-2"></i>
                Dashboard RT 011
            </a>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="header-title text-center">
        <h1>Data Penduduk RT 011</h1>
        <p class="lead">Sistem Informasi Penduduk yang Terintegrasi</p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="fas fa-users stats-icon"></i>
                    <h3 class="fw-bold">Total Penduduk</h3>
                    <p class="h2 mb-0 text-primary">150</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="fas fa-male stats-icon"></i>
                    <h3 class="fw-bold">Laki-laki</h3>
                    <p class="h2 mb-0 text-primary">80</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="fas fa-female stats-icon"></i>
                    <h3 class="fw-bold">Perempuan</h3>
                    <p class="h2 mb-0 text-primary">70</p>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Data Penduduk</h3>
                <button class="btn btn-add" onclick="window.location.href='add.php'">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Data
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pendudukTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Perkawinan</th>
                                <th>Pekerjaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendudukData as $index => $penduduk): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($penduduk['nama']); ?></td>
                                <td><?php echo htmlspecialchars($penduduk['alamat']); ?></td>
                                <td><?php echo htmlspecialchars($penduduk['usia']); ?></td>
                                <td><?php echo htmlspecialchars($penduduk['jenis_kelamin']); ?></td>
                                <td><?php echo htmlspecialchars($penduduk['status_perkawinan']); ?></td>
                                <td><?php echo htmlspecialchars($penduduk['pekerjaan']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $penduduk['id']; ?>" class="btn btn-edit me-2">Edit</a>
                                    <a href="delete.php?id=<?php echo $penduduk['id']; ?>" 
                                       class="btn btn-delete" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Penduduk RT 011</h5>
                    <p>Sistem informasi untuk mengelola data penduduk RT 011 secara efisien dan terorganisir.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Kontak</h5>
                    <p>Email: rt011@example.com<br>
                       Telp: (021) 1234567</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> RT 011. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pendudukTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>
</html>
