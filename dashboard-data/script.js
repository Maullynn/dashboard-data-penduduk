// Wait for document to be ready
$(document).ready(function() {
    // Initialize DataTable with custom configuration
    const dataTable = $('#pendudukTable').DataTable({
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
        },
        responsive: true,
        order: [[0, 'asc']],
    });

    // Update statistics function
    function updateStatistics() {
        $.ajax({
            url: 'get_statistics.php',
            method: 'GET',
            success: function(response) {
                const stats = JSON.parse(response);
                $('.stats-card:eq(0) .h2').text(stats.total);
                $('.stats-card:eq(1) .h2').text(stats.male);
                $('.stats-card:eq(2) .h2').text(stats.female);
            },
            error: function(xhr, status, error) {
                console.error('Error updating statistics:', error);
                alert('Gagal memperbarui statistik');
            }
        });
    }

    // Handle Edit Button Click
    $(document).on('click', '.btn-edit', function() {
        const row = $(this).closest('tr');
        const id = row.find('td:first').text();
        
        // Get data from the row
        const data = {
            nama: row.find('td:eq(1)').text(),
            alamat: row.find('td:eq(2)').text(),
            usia: row.find('td:eq(3)').text(),
            jenis_kelamin: row.find('td:eq(4)').text(),
            status_perkawinan: row.find('td:eq(5)').text(),
            pekerjaan: row.find('td:eq(6)').text()
        };

        // Redirect to edit page with data
        window.location.href = `edit.php?id=${id}&data=${encodeURIComponent(JSON.stringify(data))}`;
    });

    // Handle Delete Button Click
    $(document).on('click', '.btn-delete', function() {
        const row = $(this).closest('tr');
        const id = row.find('td:first').text();
        
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: 'delete.php',
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        // Remove row from DataTable
                        dataTable.row(row).remove().draw();
                        // Update statistics
                        updateStatistics();
                        alert('Data berhasil dihapus');
                    } else {
                        alert('Gagal menghapus data');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting data:', error);
                    alert('Gagal menghapus data');
                }
            });
        }
    });

    // Custom search functionality
    $('.search-bar input').on('keyup', function() {
        dataTable.search($(this).val()).draw();
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Add hover effects for buttons
    $('.btn-edit, .btn-delete').hover(
        function() { $(this).addClass('shadow-sm'); },
        function() { $(this).removeClass('shadow-sm'); }
    );

    // Handle form submission for adding new data
    $('#addPendudukForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'add.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    // Reload the page to show new data
                    window.location.reload();
                } else {
                    alert('Gagal menambahkan data');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding data:', error);
                alert('Gagal menambahkan data');
            }
        });
    });

    // Initial statistics update
    updateStatistics();

    // Refresh statistics every 5 minutes
    setInterval(updateStatistics, 300000);

    // Add responsive handling for window resize
    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            dataTable.columns.adjust();
        }, 250);
    });
});