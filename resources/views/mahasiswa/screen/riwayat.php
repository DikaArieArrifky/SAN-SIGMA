<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f4f7;
    }



    .sidebar img {
        width: 150px;
        margin: 20px auto;
    }

    .sidebar a {
        text-decoration: none;
        color: white;
        padding: 15px 20px;
        display: flex;
        align-items: center;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: #162447;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    .sidebar .logout {
        margin-top: auto;
        padding: 15px 20px;
        background-color: #e94560;
        text-align: center;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f0f4f7;
        padding: 10px 20px;
        border-bottom: 1px solid #ddd;
    }

    .header .breadcrumb {
        font-size: 14px;
        color: #555;
    }

    .header .user-info {
        display: flex;
        align-items: center;
    }

    .header .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .header .user-info span {
        font-size: 14px;
        color: #555;
    }

    .header .user-info small {
        display: block;
        font-size: 12px;
        color: #999;
    }

    .table-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-container .table-header {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-container .table-header button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        margin-right: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Add shadow */
        transition: background-color 0.3s, box-shadow 0.3s;
        /* Smooth transition */
    }

    .table-container .table-header .btn-verified {
        background-color: #28a745;
    }

    .table-container .table-header .btn-rejected {
        background-color: #dc3545;
    }

    .table-container .table-header .btn-verified:hover {
        background-color: #218838;
        /* Darker green on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        /* Bigger shadow on hover */
    }

    .table-container .table-header .btn-rejected:hover {
        background-color: #c82333;
        /* Darker red on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        /* Bigger shadow on hover */
    }

    .table-container table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-container table th,
    .table-container table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table-container table th {
        background-color: #f0f4f7;
    }

    .table-container table td .btn-view {
        padding: 7px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Add shadow */
        transition: background-color 0.3s, box-shadow 0.3s;
        /* Smooth transition */
    }

    .table-container table td .btn-view:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        /* Bigger shadow on hover */
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination button {
        padding: 10px 15px;
        border: none;
        background-color: #f0f4f7;
        cursor: pointer;
        margin: 0 5px;
    }

    .pagination button.active {
        background-color: #007bff;
        color: white;
    }

    .pagination button:hover {
        background-color: #ddd;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar img {
            width: 100px;
        }

        .content {
            margin-left: 0;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header .user-info {
            margin-top: 10px;
        }
    }

    .table-container table td i {
        margin-left: 50px;
    }

    .search-container {
        display: flex;
        justify-content: flex-end;
        position: relative;

    }

    .search-container input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-right: 10px;
    }

    .search-container button {
        padding: 10px;
        border: none;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-container button i {
        margin-right: 0;
    }

    .main-content {
        display: flex;
        margin-top: 20px;
    }

    .main-content .card {
        background-color: #b4f4fc;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-right: 20px;
        flex: 0.6;
        border: 10px;
        border-color: #333;
    }

    .main-content .card img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .main-content .card h3 {
        margin: 0;
        font-size: 24px;
        color: #000000;
    }

    .main-content .card p {
        margin: 10px 0;
        font-size: 16px;
        color: #333;
    }

    .main-content .card a {
        color: #007bff;
        text-decoration: none;
    }

    .main-content .card a:hover {
        text-decoration: underline;
    }

    .main-content .details {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        flex: 1;
        position: relative;
    }

    .main-content .details h3 {
        margin: 0;
        font-size: 24px;
        color: #5cd5da;
        margin-bottom: 20px;
    }

    .main-content .details p {
        margin: 10px 0;
        font-size: 16px;
        color: #333;
    }

    .main-content .details .back-button i {
        margin-right: 5px;
        /* Geser ikon sedikit ke kiri */
        position: relative;
        left: -2px;
        /* Menggeser ikon ke kiri */
    }

    .main-content .details a {
        color: #007bff;
        text-decoration: none;
    }

    .main-content .details a:hover {
        text-decoration: underline;
    }

    .main-content .details .back-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #009db1;
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        font-size: 15px;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .main-content .details .back-button:hover {
        background-color: #027d8d;
    }

    .main-content .card h3,
    title {
        text-align: center;
    }

    /* make tittle Politeknik Negeri Malang to center */
    .main-content .card h4 {
        text-align: center;
    }
</style>
</head>

<body>

    <div class="table-container">
        <div class="table-header">
            <button class="btn-verified" id="filter-verified">
                <i class="fas fa-filter"></i>
                Terverifikasi
            </button>
            <button class="btn-rejected">
                <i class="fas fa-filter">
                </i>
                Ditolak
            </button>
            <button class="btn-warning">
                <i class="fas fa-filter">
                </i>
                Diproses
            </button>
            <div class="search-container col-8">
                <input type="text" id="search-input" placeholder="Search...">
                <button id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>
                        Judul Lomba
                    </th>
                    <th>
                        Tanggal Lomba
                    </th>
                    <th>
                        Tempat Lomba
                    </th>
                    <th>
                        Verifikasi Dosen
                    </th>
                    <th>
                        Verifikasi Admin
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['verifikasiPenghargaan'] as $verifikasi): ?>
                    <tr>
                        <td><?= htmlspecialchars($verifikasi['judul'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($verifikasi['tanggal_mulai'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($verifikasi['tempat'] ?? '-') ?></td>
                        <td>
                            <?php if ($verifikasi['verif_pembimbing'] === 'Terverifikasi'): ?>
                                <i class="fas fa-check-circle" style="color: #28a745; font-size:2em"></i>
                            <?php elseif ($verifikasi['verif_pembimbing'] === 'DiTolak'): ?>
                                <i class="fas fa-times-circle" style="color: #dc3545; font-size:2em"></i>
                            <?php else: ?>
                                <i class="fas fa-clock" style="color: #ffc107; font-size:2em"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($verifikasi['verif_admin'] === 'Terverifikasi'): ?>
                                <i class="fas fa-check-circle" style="color: #28a745;  font-size:2em;"></i>
                            <?php elseif ($verifikasi['verif_admin'] === 'DiTolak'): ?>
                                <i class="fas fa-times-circle" style="color: #dc3545;  font-size:2em;"></i>
                            <?php else: ?>
                                <i class="fas fa-clock" style="color: #ffc107 ; font-size:2em"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn-view " data-toggle="modal" data-target="#modal-prestasi" onclick="viewDetail(<?= $verifikasi['id'] ?>)">
                                Lihat
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
        <!-- <div class="pagination">
            <button>
                Prev
            </button>
            <button class="active">
                1
            </button>
            <button>
                2
            </button>
            <button>
                ...
            </button>
            <button>
                10
            </button>
            <button>
                Next
            </button>
        </div> -->
    </div>
    </div>
</body>


<div id="modal-prestasi" class="modal fade" role="dialog">

    <body>
        <div class="content">
            <div class="main-content">
                <div class="card">
                    <img alt="Kalau ini muncul berarrti gambar gada" height="200"
                        src="https://storage.googlea"
                        width="0" />
                    <h3>
                        Kompetisi Basket
                    </h3>
                    <p></p>
                    <h4>Politeknik Negeri Malang</h4>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>URL:</strong></label>
                        <a href="" class="form-control" style="display: block; text-decoration: none; background-color: #e8f0fe; border: 1px solid #b4f4fc; padding: 6px 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">https://www.tiktok.com/@pendekarnasi/video/7342740209051684101</a>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Peringkat:</strong></label>
                        <input type="text" class="form-control" readonly style="background-color: #e8f0fe; border: 1px solid #b4f4fc;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Tingkat Lomba:</strong></label>
                        <input type="text" class="form-control" readonly style="background-color: #e8f0fe; border: 1px solid #b4f4fc;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Tanggal Mulai:</strong></label>
                        <input type="text" class="form-control" readonly style="background-color: #e8f0fe; border: 1px solid #b4f4fc;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Tanggal Akhir:</strong></label>
                        <input type="text" class="form-control" readonly style="background-color: #e8f0fe; border: 1px solid #b4f4fc;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Jumlah Instansi:</strong></label>
                        <input type="text" class="form-control" readonly style="background-color: #e8f0fe; border: 1px solid #b4f4fc;">
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Jumlah Peserta:</strong></label>
                        <input type="text" class="form-control" readonly style="background-color: #e8f0fe; border: 1px solid #b4f4fc;">
                    </div>
                </div>
                <div class="details">
                    <h3>Detail Prestasi</h3>
                    <a class="back-button" data-dismiss="modal" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Nama Pembimbing:</strong></label>
                        <input type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Verifikasi Pembimbing:</strong></label>
                        <input type="text" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Pesan Pembimbing:</strong></label>
                        <textarea class="form-control" readonly>Lengkap</textarea>
                    </div>

                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Verifikasi Admin:</strong></label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Pesan Admin:</strong></label>
                        <textarea class="form-control" readonly>Sudah Lengkap</textarea>
                    </div>

                    <h3>Dokumen Prestasi</h3>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>File Sertifikat Lomba:</strong></label>
                        <button class="doc-link" onclick="previewFile('sertifikat')"><i class="fas fa-eye"></i> Preview Sertifikat</button>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>File Poster:</strong></label>
                        <button class="doc-link" onclick="previewFile('poster')"><i class="fas fa-eye"></i> Preview Poster</button>
                    </div>
                    <div class="scoreTambah">
                        <h3>Jika Berhasil Terverifikasi</h3>
                    </div>


                    <script>
                        $(document).ready(function() {
                            // Existing search functionality
                            $('#search-button').click(function() {
                                var searchValue = $('#search-input').val().toLowerCase();
                                filterTable(searchValue, null);
                            });

                            $('#search-input').on('keyup', function() {
                                var searchValue = $(this).val().toLowerCase();
                                filterTable(searchValue, null);
                            });

                            // Filter buttons functionality
                            $('#filter-verified').click(function() {
                                $(this).toggleClass('active');
                                if ($(this).hasClass('active')) {
                                    $('tbody tr').hide();
                                    $('tbody tr').filter(function() {
                                        return $(this).find('td:eq(3) i').hasClass('fa-check-circle') &&
                                            $(this).find('td:eq(4) i').hasClass('fa-check-circle');
                                    }).show();
                                } else {
                                    $('tbody tr').show();
                                }
                            });

                            $('.btn-rejected').click(function() {
                                $(this).toggleClass('active');
                                if ($(this).hasClass('active')) {
                                    $('tbody tr').hide();
                                    $('tbody tr').filter(function() {
                                        return $(this).find('td:eq(3) i').hasClass('fa-times-circle') ||
                                            $(this).find('td:eq(4) i').hasClass('fa-times-circle');
                                    }).show();
                                } else {
                                    $('tbody tr').show();
                                }
                            });


                            $('.btn-warning').click(function() {
                                $(this).toggleClass('active');
                                if ($(this).hasClass('active')) {
                                    $('tbody tr').hide();
                                    $('tbody tr').filter(function() {
                                        return $(this).find('td:eq(3) i').hasClass('fa-clock') ||
                                            $(this).find('td:eq(4) i').hasClass('fa-clock');
                                    }).show();
                                } else {
                                    $('tbody tr').show();
                                }
                            });

                            // Helper function to filter table
                            function filterTable(searchValue, status) {
                                $('tbody tr').hide();
                                $('tbody tr').filter(function() {
                                    var text = $(this).text().toLowerCase();
                                    return text.indexOf(searchValue) > -1;
                                }).show();
                            }
                        });

                        function viewDetail(verifikasiId) {
                            $.ajax({
                                url: 'getVerifikasiDetail',
                                type: 'POST',
                                data: {
                                    id: verifikasiId
                                },
                                success: function(response) {
                                    const data = JSON.parse(response);

                                    // Update modal content
                                    $('.card img').attr('src', '<?= IMG ?>/file-prestasi/' + (data.file_photo_kegiatan || 'https://api.dicebear.com/6.x/avataaars/svg?seed='));
                                    $('.card h3').text(data.judul);
                                    $('.card h4').text(data.tempat);

                                    // Update URL
                                    $('.form-group a ').attr('href', data.url).text(data.url);

                                    // Update form fields
                                    $('.card .form-control').each(function() {
                                        const field = $(this).prev('label').text().toLowerCase().replace(':', '');
                                        switch (field) {
                                            case 'peringkat':
                                                $(this).val(data.peringkat_nama);
                                                break;
                                            case 'tingkat lomba':
                                                $(this).val(data.tingkatan_nama);
                                                break;
                                            case 'tanggal mulai':
                                                $(this).val(formatDate(data.tanggal_mulai));
                                                break;
                                            case 'tanggal akhir':
                                                $(this).val(formatDate(data.tanggal_akhir));
                                                break;
                                            case 'jumlah instansi':
                                                $(this).val(data.jumlah_instansi);
                                                break;
                                            case 'jumlah peserta':
                                                $(this).val(data.jumlah_peserta);
                                                break;
                                        }
                                    });

                                    // Update verification details
                                    $('.details .form-control').each(function() {
                                        const field = $(this).prev('label').text().toLowerCase().replace(':', '');
                                        switch (field) {
                                            case 'nama pembimbing':

                                                $(this).val(data.dosen_name);
                                                break;
                                            case 'verifikasi admin':
                                                $(this).val(data.verif_admin);
                                                if (data.verif_admin === 'Terverifikasi') {
                                                    $(this).css({
                                                        'color': '#28a745',
                                                        'font-weight': 'bold',
                                                        'background': 'linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.2) 100%)',
                                                        'border-radius': '6px',
                                                        'padding': '4px 12px',
                                                        'text-shadow': '0 1px 1px rgba(0,0,0,0.1)`',
                                                        'transition': 'all 0.3s ease'
                                                    });
                                                } else if (data.verif_admin === 'DiTolak') {
                                                    $(this).css({
                                                        'color': '#dc3545',
                                                        'font-weight': 'bold',
                                                        'background': 'linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.2) 100%)',

                                                        'border-radius': '6px',
                                                        'padding': '4px 12px',
                                                        'text-shadow': '0 1px 1px rgba(0,0,0,0.1)',

                                                        'transition': 'all 0.3s ease'
                                                    });
                                                } else {
                                                    $(this).css({
                                                        'color': '#ffc107',
                                                        'font-weight': 'bold',
                                                        'background': 'linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%)',

                                                        'border-radius': '6px',
                                                        'padding': '4px 12px',

                                                        'box-shadow': '0 2px 4px rgba(255, 193, 7, 0.15)',
                                                        'transition': 'all 0.3s ease'
                                                    });
                                                }
                                                break;
                                            case 'pesan admin':
                                                $(this).val(data.pesan_admin);
                                                break;
                                            case 'verifikasi pembimbing':
                                                $(this).val(data.verif_pembimbing);
                                                if (data.verif_pembimbing === 'Terverifikasi') {
                                                    $(this).css({
                                                        'color': '#28a745',
                                                        'font-weight': 'bold',
                                                        'background': 'linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.2) 100%)',
                                                        'border-radius': '6px',
                                                        'padding': '4px 12px',
                                                        'text-shadow': '0 1px 1px rgba(0,0,0,0.1)`',
                                                        'transition': 'all 0.3s ease'
                                                    });
                                                } else if (data.verif_pembimbing === 'DiTolak') {
                                                    $(this).css({
                                                        'color': '#dc3545',
                                                        'font-weight': 'bold',
                                                        'background': 'linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.2) 100%)',

                                                        'border-radius': '6px',
                                                        'padding': '4px 12px',
                                                        'text-shadow': '0 1px 1px rgba(0,0,0,0.1)',

                                                        'transition': 'all 0.3s ease'
                                                    });
                                                } else {
                                                    $(this).css({
                                                        'color': '#ffc107',
                                                        'font-weight': 'bold',
                                                        'background': 'linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.2) 100%)',

                                                        'border-radius': '6px',
                                                        'padding': '4px 12px',

                                                        'box-shadow': '0 2px 4px rgba(255, 193, 7, 0.15)',
                                                        'transition': 'all 0.3s ease'
                                                    });
                                                }
                                                break;
                                            case 'pesan pembimbing':
                                                $(this).val(data.pesan_pembimbing);
                                                break;
                                        }
                                    });
                                    $('.scoreTambah').html('<h3> +' + data.score + ' Jika  Berhasil Terverifikasi</h3>');
                                    // Update document links
                                    if (data.file_sertifikat) {
                                        $('.doc-link[onclick="previewFile(\'sertifikat\')"]').attr('data-file', '<?= IMG ?>/file-prestasi/' + data.file_sertifikat);
                                    }
                                    if (data.file_poster) {
                                        $('.doc-link[onclick="previewFile(\'poster\')"]').attr('data-file', '<?= IMG ?>/file-prestasi/' + data.file_poster);
                                    }

                                    $('#modal-prestasi').modal('show');
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Gagal'
                                    });
                                }
                            });
                        }

                        // Helper function to format date
                        function formatDate(dateString) {
                            if (!dateString) return '-';
                            const date = new Date(dateString);
                            return date.toLocaleDateString('id-ID');
                        }

                        // Update preview file function
                        function previewFile(type) {
                            const link = $(`.doc-link[onclick="previewFile('${type}')"]`);
                            const file = link.attr('data-file');
                            if (file) {
                                window.open(file, '_blank');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No file available'
                                });
                            }
                        }
                    </script>
                    
                    <a class="back-button" data-dismiss="modal" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <style>
                    .doc-link {
                        color: #007bff;
                        text-decoration: none;
                        padding: 5px 10px;
                        border: 1px solid #007bff;
                        border-radius: 4px;
                    }

                    .doc-link:hover {
                        background-color: #007bff;
                        color: white;
                    }

                    /* Enhanced Modal and Card Styles */
                    .main-content .card {
                        background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
                        padding: 25px;
                        border-radius: 15px;
                        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                        margin-right: 20px;
                        flex: 0.6;
                        transform: translateY(0);
                        transition: all 0.3s ease;
                    }

                    .main-content .card:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
                    }

                    /* Enhanced Table Styles */
                    .table-container {
                        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
                        padding: 25px;
                        border-radius: 15px;
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
                    }

                    .table-container table tr {
                        transition: all 0.3s ease;
                    }

                    .table-container table tr:hover {
                        background-color: rgba(0, 123, 255, 0.05);
                        transform: scale(1.01);
                    }

                    /* Enhanced Button Styles */
                    .btn-view {
                        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                        padding: 8px 16px;
                        border-radius: 8px;
                        color: white;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    }

                    .btn-view:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
                    }

                    /* Filter Buttons Animation */
                    .table-header button {
                        position: relative;
                        overflow: hidden;
                        transition: all 0.3s ease;
                    }

                    .table-header button::after {
                        content: '';
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 0;
                        height: 0;
                        background: rgba(255, 255, 255, 0.2);
                        border-radius: 50%;
                        transform: translate(-50%, -50%);
                        transition: width 0.6s ease, height 0.6s ease;
                    }

                    .table-header button:hover::after {
                        width: 200%;
                        height: 200%;
                    }

                    /* Search Bar Enhancement */
                    .search-container input {
                        border: 2px solid #e9ecef;
                        border-radius: 8px;
                        padding: 12px 20px;
                        transition: all 0.3s ease;
                    }

                    .search-container input:focus {
                        border-color: #007bff;
                        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
                        outline: none;
                    }

                    /* Loading Animation */
                    .loading {
                        position: relative;
                    }

                    .loading::after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                        animation: loading 1.5s infinite;
                    }

                    @keyframes loading {
                        0% {
                            transform: translateX(-100%);
                        }

                        100% {
                            transform: translateX(100%);
                        }
                    }

                    /* Modal Enhancements */
                    .modal .form-control {
                        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                        border: none;
                        border-radius: 8px;
                        padding: 12px;
                        transition: all 0.3s ease;
                    }

                    .modal .form-control:focus {
                        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
                    }

                    /* Document Preview Button */
                    .doc-link {
                        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
                        border: 2px solid #007bff;
                        padding: 8px 16px;
                        border-radius: 8px;
                        transition: all 0.3s ease;
                    }

                    .doc-link:hover {
                        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                        transform: translateY(-2px);
                    }

                    /* Status Icons Animation */
                    .fa-check-circle,
                    .fa-times-circle,
                    .fa-clock {
                        transition: all 0.3s ease;
                    }

                    .fa-check-circle:hover {
                        transform: scale(1.2);
                        color: #1e7e34 !important;
                    }

                    .fa-times-circle:hover {
                        transform: scale(1.2);
                        color: #bd2130 !important;
                    }

                    .fa-clock:hover {
                        transform: scale(1.2);
                        color: #d39e00 !important;
                    }
                </style>
            </div>
        </div>
</div>
</body>
</div>