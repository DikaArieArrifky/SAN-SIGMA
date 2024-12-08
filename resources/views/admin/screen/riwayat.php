<body>

    <div class="table-container">
        <div class="table-header">

            <button class="btn-info" onclick="sortByName()">
                <i class="fas fa-filter"></i>
                Nama
            </button>
            <button class="btn-info" onclick="sortByTingkatan()">
                <i class="fas fa-filter">
                </i>
                Tingkat
            </button>
            <button class="btn-info" onclick="sortByJudul()">
                <i class="fas fa-filter">
                </i>
                Judul
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
                        Nama Mahasiswa
                    </th>
                    <th>
                        Tanggal Lomba
                    </th>
                    <th>
                        Judul Lomba
                    </th>
                    <th>
                        Tingkatan
                    </th>
                    <th>
                        Verifikasi Admin
                    </th>
                    <th>
                        Verifikasi Dosen
                    </th>
                    <th>
                        Aksi
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['verifikasiPenghargaanOv'] as $verifikasi): ?>
                    <tr>
                        <td><?= htmlspecialchars($verifikasi['mahasiswa_name'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($verifikasi['tanggal_mulai'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($verifikasi['judul'] ?? '-') ?></td>
                        <td>
                            <?= htmlspecialchars($verifikasi['tingkatan_nama'] ?? '-') ?></td>
                        </td>
                        <td>
                            <?php if ($verifikasi['verif_admin'] === 'Terverifikasi'): ?>
                                <i class="fas fa-check-circle" style="color: #28a745;  font-size: 2.5em;"></i>
                            <?php elseif ($verifikasi['verif_admin'] === 'DiTolak'): ?>
                                <i class="fas fa-times-circle" style="color: #dc3545;  font-size: 2.5em;"></i>
                            <?php else: ?>
                                <i class="fas fa-clock" style="color: #ffc107; font-size: 2.5em;"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($verifikasi['verif_pembimbing'] === 'Terverifikasi'): ?>
                                <i class="fas fa-check-circle" style="color: #28a745; font-size:2.5em"></i>
                            <?php elseif ($verifikasi['verif_pembimbing'] === 'DiTolak'): ?>
                                <i class="fas fa-times-circle" style="color: #dc3545; font-size:2.5em"></i>
                            <?php else: ?>
                                <i class="fas fa-clock" style="color: #ffc107; font-size:2.5em"></i>
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
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Nama Mahasiswa:</strong></label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Prodi:</strong></label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 16px;"><strong>Mahasiswa Angkatan:</strong></label>
                        <input type="text" class="form-control" readonly>
                    </div>

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

                    <form method="POST" action="verifikasi_prestasi">
                        <input type="hidden" name="pengId" id="pengId">
                        <input type="hidden" name="id_admin" value=" <?= htmlspecialchars($data['admin']['id'] ?? '') ?>">
                        <div class="form-group verification-group">
                    </form>
                </div>
            </div>

          

            <script>
                //button sort
                function resetSortButtons(exceptButton) {
                    const buttons = document.querySelectorAll('.btn-info');
                    buttons.forEach(button => {
                        if (button !== exceptButton) {
                            button.removeAttribute('data-sort');
                            const icon = button.querySelector('i');
                            icon.className = 'fas fa-sort';
                        }
                    });
                }

                function sortByName() {
                    const table = document.querySelector('table');
                    const rows = Array.from(table.querySelectorAll('tbody tr'));
                    const button = document.querySelector('button[onclick="sortByName()"]');
                    const isAscending = button.getAttribute('data-sort') !== 'asc';

                    resetSortButtons(button);
                    button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
                    updateSortIcon(button, isAscending);

                    rows.sort((a, b) => {
                        const nameA = a.cells[0].textContent.trim().toLowerCase();
                        const nameB = b.cells[0].textContent.trim().toLowerCase();
                        return isAscending ?
                            nameA.localeCompare(nameB) :
                            nameB.localeCompare(nameA);
                    });

                    const tbody = table.querySelector('tbody');
                    tbody.innerHTML = '';
                    rows.forEach(row => tbody.appendChild(row));
                }

                function sortByTingkatan() {
                    const table = document.querySelector('table');
                    const rows = Array.from(table.querySelectorAll('tbody tr'));
                    const button = document.querySelector('button[onclick="sortByTingkatan()"]');
                    const isAscending = button.getAttribute('data-sort') !== 'asc';

                    resetSortButtons(button);
                    button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
                    updateSortIcon(button, isAscending);

                    rows.sort((a, b) => {
                        const tingkatanA = a.cells[3].textContent.trim().toLowerCase();
                        const tingkatanB = b.cells[3].textContent.trim().toLowerCase();
                        return isAscending ?
                            tingkatanA.localeCompare(tingkatanB) :
                            tingkatanB.localeCompare(tingkatanA);
                    });

                    const tbody = table.querySelector('tbody');
                    tbody.innerHTML = '';
                    rows.forEach(row => tbody.appendChild(row));
                }

                function sortByJudul() {
                    const table = document.querySelector('table');
                    const rows = Array.from(table.querySelectorAll('tbody tr'));
                    const button = document.querySelector('button[onclick="sortByJudul()"]');
                    const isAscending = button.getAttribute('data-sort') !== 'asc';

                    resetSortButtons(button);
                    button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
                    updateSortIcon(button, isAscending);

                    rows.sort((a, b) => {
                        const judulA = a.cells[2].textContent.trim().toLowerCase();
                        const judulB = b.cells[2].textContent.trim().toLowerCase();
                        return isAscending ?
                            judulA.localeCompare(judulB) :
                            judulB.localeCompare(judulA);
                    });

                    const tbody = table.querySelector('tbody');
                    tbody.innerHTML = '';
                    rows.forEach(row => tbody.appendChild(row));
                }

                function updateSortIcon(button, isAscending) {
                    const icon = button.querySelector('i');
                    icon.className = isAscending ?
                        'fas fa-sort-up' :
                        'fas fa-sort-down';
                }

                // Update the button HTML to include sort icons
                document.addEventListener('DOMContentLoaded', function() {
                    const buttons = document.querySelectorAll('.btn-info');
                    buttons.forEach(button => {
                        const icon = button.querySelector('i');
                        icon.className = 'fas fa-sort';
                    });
                });
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
                            $('#pengId').val(data.pengId);

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
                                    case 'nama mahasiswa':
                                        $(this).val(data.mahasiswa_name + ' -  NIM : ' + data.nim);
                                        break;
                                    case 'prodi':
                                        $(this).val(data.prodi);
                                        break;

                                    case 'mahasiswa angkatan':
                                        $(this).val(data.angkatan);
                                        break;
                                    case 'nama pembimbing':
                                        $(this).val(data.dosen_name + ' - NIP : ' + data.dosen_nip);
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
                            // $('.scoreTambah').html('<h3> +' + data.score + ' Jika  Berhasil Terverifikasi</h3>');
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


</div>
</div>
</div>
</body>



