<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Program Studi</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProdiModal">
                <i class="fas fa-plus"></i> Tambah Prodi
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Program Studi...">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="prodiTableBody">
                        <?php foreach ($data['prodis'] as $index => $prodi): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="editable" data-id="<?= $prodi['id'] ?>"><?= htmlspecialchars($prodi['nama']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-prodi"
                                        data-nama="<?= htmlspecialchars($prodi['nama']) ?>"

                                        data-toggle="modal" data-target="#editProdiModal">

                                        <i class="fas fa-edit"></i>


                                    </button>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-prodi"
                                        data-id="<?= $prodi['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-center">
                        <!-- Pagination links will be dynamically generated here -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Add Prodi Modal -->
<div class="modal fade" id="addProdiModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Program Studi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addProdiForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Program Studi</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Prodi Modal -->
<div class="modal fade" id="editProdiModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Program Studi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProdiForm">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Program Studi</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        font-size: 1.2rem;
        /* Increase the base font size */
    }

    #searchInput,
    .btn-primary {
        font-size: 1rem;
        /* Keep the original font size for search input and button */
    }

    .table th,
    .table td {
        font-size: 1.3rem;
        /* Keep the original font size for table headers and data */
    }
</style>

<script>
    $(document).ready(function() {
        // Add Prodi
        $('#addProdiForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'createProdi',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Program studi berhasil ditambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseText
                    });
                }
            });
        });

        // Edit Prodi



        $('#editProdiForm').on('submit', function(e) {
            e.preventDefault();
            const originalId = $('#editProdiForm [name=id]').val();
            const originalNama = $('#editProdiForm [name=nama]').data('original-nama');
            const currentNama = $('#editProdiForm [name=nama]').val();

            if (originalNama === currentNama) {
                Swal.fire({
                    icon: 'info',
                    title: 'No Changes',
                    text: 'No changes were made to the prodi.'
                });
                return;
            }

            $.ajax({
                url: 'updateProdi',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseText
                    });
                }
            });
        });

        // Delete Prodi
        $('.delete-prodi').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data program studi akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'deleteProdi',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Program studi berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseText
                            });
                        }
                    });
                }
            });
        });

        // Inline Editing
        $(document).on('dblclick', '.editable', function() {
            const id = $(this).data('id');
            const currentText = $(this).text();
            const input = $('<input>', {
                type: 'text',
                value: currentText,
                class: 'form-control'
            });
            $(this).html(input);
            input.focus();

            input.on('blur', function() {
                const newText = $(this).val();
                $.ajax({
                    url: 'updateProdi',
                    type: 'POST',
                    data: {
                        id: id,
                        nama: newText
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Program studi berhasil diupdate',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText
                        });
                    }
                });
            });
        });

        // Search Functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#prodiTableBody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Pagination (Assuming you have a pagination mechanism in place)
        // This is just a placeholder for pagination logic
        function loadPage(page) {
            // Load the data for the specified page
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const page = $(this).attr('data-page');
            loadPage(page);
        });
    });
</script>