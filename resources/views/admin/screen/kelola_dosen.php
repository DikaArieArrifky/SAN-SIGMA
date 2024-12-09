<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Dosen</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addDosenModal">
                <i class="fas fa-plus"></i> Tambah Dosen
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Dosen...">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>NIP</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Photo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dosenTableBody">
                        <?php foreach ($data['dosens'] as $index => $dosen): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="editable" data-id="<?= $dosen['nip'] ?>"><?= htmlspecialchars($dosen['name']) ?></td>
                                <td><?= htmlspecialchars($dosen['nip']) ?></td>
                                <td><?= htmlspecialchars($dosen['gender']) ?></td>
                                <td><?= htmlspecialchars($dosen['phone_number']) ?></td>
                                <td><img src="<?=IMG . '/person/' . htmlspecialchars($dosen['photo']) ?>" alt="Photo" width="50"></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-dosen"
                                        data-id="<?= $dosen['nip'] ?>"
                                        data-user_id="<?= $dosen['user_id'] ?>"
                                        data-name="<?= htmlspecialchars($dosen['name']) ?>"
                                        data-nip="<?= htmlspecialchars($dosen['nip']) ?>"
                                        data-gender="<?= htmlspecialchars($dosen['gender']) ?>"
                                        data-phone_number="<?= htmlspecialchars($dosen['phone_number']) ?>"
                                        data-photo="<?= htmlspecialchars($dosen['photo']) ?>"
                                        data-alamat="<?= htmlspecialchars($dosen['Alamat']) ?>"
                                        data-kota="<?= htmlspecialchars($dosen['Kota']) ?>"
                                        data-provinsi="<?= htmlspecialchars($dosen['Provinsi']) ?>"
                                        data-agama="<?= htmlspecialchars($dosen['agama']) ?>"
                                        data-prodi_id="<?= htmlspecialchars($dosen['prodi_id']) ?>"
                                        data-status="<?= htmlspecialchars($dosen['status']) ?>"
                                        data-toggle="modal" data-target="#editDosenModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-dosen"
                                        data-id="<?= $dosen['nip'] ?>"
                                        data-user_id="<?= $dosen['user_id'] ?>">
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
<!-- Add Dosen Modal -->
<div class="modal fade" id="addDosenModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dosen</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addDosenForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input type="text" class="form-control modal-input" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control modal-input" name="nip" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control modal-input" name="gender" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control modal-input" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="text" class="form-control modal-input" name="photo" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control modal-input" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" class="form-control modal-input" name="kota" required>
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control modal-input" name="provinsi" required>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control modal-input" name="agama" required>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select class="form-control modal-input" name="prodi_id" required>
                            <?php foreach ($data['prodis'] as $prodi): ?>
                                <option value="<?= $prodi['id'] ?>"><?= htmlspecialchars($prodi['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control modal-input" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
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

<!-- Edit Dosen Modal -->
<div class="modal fade" id="editDosenModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Dosen</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDosenForm">
                <input type="hidden" name="nip">
                <input type="hidden" name="user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input type="text" class="form-control modal-input" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control modal-input" name="nip" required readonly>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control modal-input" name="gender" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control modal-input" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="text" class="form-control modal-input" name="photo" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control modal-input" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" class="form-control modal-input" name="kota" required>
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control modal-input" name="provinsi" required>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control modal-input" name="agama" required>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select class="form-control modal-input" name="prodi_id" required>
                            <?php foreach ($data['prodis'] as $prodi): ?>
                                <option value="<?= $prodi['id'] ?>"><?= htmlspecialchars($prodi['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control modal-input" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
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
        // Add Dosen
        $('#addDosenForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'createDosen',
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

        // Edit Dosen
        $(document).on('click', '.edit-dosen', function() {
            const nip = $(this).data('id');
            const user_id = $(this).data('user_id');
            const name = $(this).data('name');
            const gender = $(this).data('gender');
            const phone_number = $(this).data('phone_number');
            const photo = $(this).data('photo');
            const alamat = $(this).data('alamat');
            const kota = $(this).data('kota');
            const provinsi = $(this).data('provinsi');
            const agama = $(this).data('agama');
            const prodi_id = $(this).data('prodi_id');
            const status = $(this).data('status');
            $('#editDosenForm [name=nip]').val(nip);
            $('#editDosenForm [name=user_id]').val(user_id);
            $('#editDosenForm [name=name]').val(name);
            $('#editDosenForm [name=gender]').val(gender);
            $('#editDosenForm [name=phone_number]').val(phone_number);
            $('#editDosenForm [name=photo]').val(photo);
            $('#editDosenForm [name=alamat]').val(alamat);
            $('#editDosenForm [name=kota]').val(kota);
            $('#editDosenForm [name=provinsi]').val(provinsi);
            $('#editDosenForm [name=agama]').val(agama);
            $('#editDosenForm [name=prodi_id]').val(prodi_id);
            $('#editDosenForm [name=status]').val(status);
            $('#editDosenModal').modal('show');
        });

        $('#editDosenForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'updateDosen',
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

        // Delete Dosen
        $('.delete-dosen').click(function() {
            const nip = $(this).data('id');
            const user_id = $(this).data('user_id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data dosen akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'deleteDosen',
                        type: 'POST',
                        data: {
                            nip: nip,
                            user_id: user_id
                        },
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
            $('#dosenTableBody tr').filter(function() {
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
        height: fit-content;
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
    .modal-input {
        font-size: 1.5rem;
        height: fit-content;
    }
</style>