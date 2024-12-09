<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Peringkat</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addPeringkatModal">
                <i class="fas fa-plus"></i> Tambah Peringkat
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Peringkat...">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peringkat</th>
                            <th>Multiple</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="peringkatTableBody">
                        <?php foreach ($data['peringkats'] as $index => $peringkat): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="editable" data-id="<?= $peringkat['id'] ?>"><?= htmlspecialchars($peringkat['nama']) ?></td>
                                <td><?= $peringkat['multiple'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-peringkat"
                                        data-id="<?= $peringkat['id'] ?>"
                                        data-nama="<?= htmlspecialchars($peringkat['nama']) ?>"
                                        data-multiple="<?= $peringkat['multiple'] ?>"
                                        data-toggle="modal" data-target="#editPeringkatModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-peringkat"
                                        data-id="<?= $peringkat['id'] ?>">
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

<!-- Add Peringkat Modal -->
<div class="modal fade" id="addPeringkatModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peringkat</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPeringkatForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Peringkat</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Multiple</label>
                        <input type="number" step="0.1" class="form-control" name="multiple" required>
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

<!-- Edit Peringkat Modal -->
<div class="modal fade" id="editPeringkatModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Peringkat</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPeringkatForm">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Peringkat</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Multiple</label>
                        <input type="number" step="0.1" class="form-control" name="multiple" required>
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
    // Add Peringkat
    $('#addPeringkatForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'createPeringkat',
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

    // Edit Peringkat
    $(document).on('click', '.edit-peringkat', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const multiple = $(this).data('multiple');
        $('#editPeringkatForm [name=id]').val(id);
        $('#editPeringkatForm [name=nama]').val(nama);
        $('#editPeringkatForm [name=multiple]').val(multiple);
        $('#editPeringkatModal').modal('show');
    });

    $('#editPeringkatForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'updatePeringkat',
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

    // Delete Peringkat
    $('.delete-peringkat').click(function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data peringkat akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'deletePeringkat',
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
        $('#peringkatTableBody tr').filter(function() {
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