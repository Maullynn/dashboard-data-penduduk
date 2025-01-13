<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #4e73df;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(78,115,223,0.25);
            border-color: #4e73df;
        }
        .btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s;
        }
        .btn-primary {
            background-color: #4e73df;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
        }
        .form-label {
            font-weight: 600;
            color: #4e73df;
        }
        .input-group-text {
            background-color: #4e73df;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    Tambah Data Penduduk
                </h2>
            </div>
            <div class="card-body p-4">
                <form action="create.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-4">
                        <label for="nama" class="form-label">
                            <i class="fas fa-user me-2"></i>Nama
                        </label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <div class="invalid-feedback">
                            Mohon isi nama lengkap
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label">
                            <i class="fas fa-home me-2"></i>Alamat
                        </label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Mohon isi alamat lengkap
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="usia" class="form-label">
                            <i class="fas fa-birthday-cake me-2"></i>Usia
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="usia" name="usia" required>
                            <span class="input-group-text">Tahun</span>
                        </div>
                        <div class="invalid-feedback">
                            Mohon isi usia
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="jenis_kelamin" class="form-label">
                                <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin
                            </label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                Mohon pilih jenis kelamin
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="status_perkawinan" class="form-label">
                                <i class="fas fa-ring me-2"></i>Status Perkawinan
                            </label>
                            <select class="form-select" id="status_perkawinan" name="status_perkawinan" required>
                                <option value="">Pilih Status Perkawinan</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai">Cerai</option>
                            </select>
                            <div class="invalid-feedback">
                                Mohon pilih status perkawinan
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="pekerjaan" class="form-label">
                            <i class="fas fa-briefcase me-2"></i>Pekerjaan
                        </label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                        <div class="invalid-feedback">
                            Mohon isi pekerjaan
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php" class="btn btn-secondary me-md-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>