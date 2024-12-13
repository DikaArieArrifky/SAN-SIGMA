<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tingkatan</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addTingkatanModal">
                <i class="fas fa-plus"></i> Tambah Tingkatan
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Tingkatan...">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tingkatan</th>
                            <th>Point</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tingkatanTableBody">
                        <?php foreach ($data['tingkatans'] as $index => $tingkatan): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="editable" data-id="<?= $tingkatan['id'] ?>"><?= htmlspecialchars($tingkatan['nama']) ?></td>
                                <td><?= $tingkatan['point'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-tingkatan"
                                        data-id="<?= $tingkatan['id'] ?>"
                                        data-nama="<?= htmlspecialchars($tingkatan['nama']) ?>"
                                        data-point="<?= $tingkatan['point'] ?>"
                                        data-toggle="modal" data-target="#editTingkatanModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-tingkatan"
                                        data-id="<?= $tingkatan['id'] ?>">
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

<!-- Add Tingkatan Modal -->
<div class="modal fade" id="addTingkatanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tingkatan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addTingkatanForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tingkatan</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Point</label>
                        <input type="number" class="form-control" name="point" required>
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

<!-- Edit Tingkatan Modal -->
<div class="modal fade" id="editTingkatanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tingkatan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTingkatanForm">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tingkatan</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Point</label>
                        <input type="number" class="form-control" name="point" required>
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

<script>
$(document).ready(function() {
    // Add Tingkatan
    $('#addTingkatanForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'createTingkatan',
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

    // Edit Tingkatan
    $(document).on('click', '.edit-tingkatan', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const point = $(this).data('point');
        $('#editTingkatanForm [name=id]').val(id);
        $('#editTingkatanForm [name=nama]').val(nama);
        $('#editTingkatanForm [name=point]').val(point);
        $('#editTingkatanModal').modal('show');
    });

    $('#editTingkatanForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'updateTingkatan',
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

    // Delete Tingkatan
    $('.delete-tingkatan').click(function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data tingkatan akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'deleteTingkatan',
                    type: 'POST',
                    data: { id: id },
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
            }
        });
    });

    // Search Functionality
    $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#tingkatanTableBody tr').filter(function() {
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