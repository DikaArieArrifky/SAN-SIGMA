<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addMahasiswaModal">
                <i class="fas fa-plus"></i> Tambah Mahasiswa
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Mahasiswa...">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Photo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="mahasiswaTableBody">
                        <?php foreach ($data['mahasiswas'] as $index => $mahasiswa): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="editable" data-id="<?= $mahasiswa['nim'] ?>"><?= htmlspecialchars($mahasiswa['name']) ?></td>
                                <td><?= htmlspecialchars($mahasiswa['nim']) ?></td>
                                <td><?= htmlspecialchars($mahasiswa['gender']) ?></td>
                                <td><?= htmlspecialchars($mahasiswa['phone_number']) ?></td>
                                <td><img src="<?= IMG . '/person/' . htmlspecialchars($mahasiswa['photo']) ?>" alt="Photo" width="50"></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-mahasiswa"
                                        data-id="<?= $mahasiswa['nim'] ?>"
                                        data-user_id="<?= $mahasiswa['user_id'] ?>"
                                        data-name="<?= htmlspecialchars($mahasiswa['name']) ?>"
                                        data-nim="<?= htmlspecialchars($mahasiswa['nim']) ?>"
                                        data-gender="<?= htmlspecialchars($mahasiswa['gender']) ?>"
                                        data-phone_number="<?= htmlspecialchars($mahasiswa['phone_number']) ?>"
                                        data-photo="<?= htmlspecialchars($mahasiswa['photo']) ?>"
                                        data-alamat="<?= htmlspecialchars($mahasiswa['Alamat']) ?>"
                                        data-kota="<?= htmlspecialchars($mahasiswa['Kota']) ?>"
                                        data-provinsi="<?= htmlspecialchars($mahasiswa['Provinsi']) ?>"
                                        data-agama="<?= htmlspecialchars($mahasiswa['agama']) ?>"
                                        data-prodi_id="<?= htmlspecialchars($mahasiswa['prodi_id']) ?>"
                                        data-college_year="<?= htmlspecialchars($mahasiswa['college_year']) ?>"
                                        data-status="<?= htmlspecialchars($mahasiswa['status']) ?>"
                                        data-toggle="modal" data-target="#editMahasiswaModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-mahasiswa"
                                        data-id="<?= $mahasiswa['nim'] ?>"
                                        data-user_id="<?= $mahasiswa['user_id'] ?>">
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

<!-- Add Mahasiswa Modal -->
<div class="modal fade" id="addMahasiswaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addMahasiswaForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control modal-input" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control modal-input" name="nim" required>
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
                        <label>Tahun Masuk</label>
                        <input type="number" class="form-control modal-input" name="college_year" required>
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

<!-- Edit Mahasiswa Modal -->
<div class="modal fade" id="editMahasiswaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMahasiswaForm">
                <input type="hidden" name="mahasiswa_id">
                <input type="hidden" name="user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control modal-input" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control modal-input" name="nim" required readonly>
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
                        <label>Tahun Masuk</label>
                        <input type="number" class="form-control modal-input" name="college_year" required>
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
        // Add Mahasiswa
        $('#addMahasiswaForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'createMahasiswa',
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

        // Edit Mahasiswa
        $(document).on('click', '.edit-mahasiswa', function() {
            const id = $(this).data('nim');
            const user_id = $(this).data('user_id');
            const name = $(this).data('name');
            const nim = $(this).data('nim');
            const gender = $(this).data('gender');
            const phone_number = $(this).data('phone_number');
            const photo = $(this).data('photo');
            const alamat = $(this).data('alamat');
            const kota = $(this).data('kota');
            const provinsi = $(this).data('provinsi');
            const agama = $(this).data('agama');
            const prodi_id = $(this).data('prodi_id');
            const college_year = $(this).data('college_year');
            const status = $(this).data('status');
          
            $('#editMahasiswaForm [name=name]').val(name);
            $('#editMahasiswaForm [name=user_id]').val(user_id);
            $('#editMahasiswaForm [name=nim]').val(nim);
            $('#editMahasiswaForm [name=gender]').val(gender);
            $('#editMahasiswaForm [name=phone_number]').val(phone_number);
            $('#editMahasiswaForm [name=photo]').val(photo);
            $('#editMahasiswaForm [name=alamat]').val(alamat);
            $('#editMahasiswaForm [name=kota]').val(kota);
            $('#editMahasiswaForm [name=provinsi]').val(provinsi);
            $('#editMahasiswaForm [name=agama]').val(agama);
            $('#editMahasiswaForm [name=prodi_id]').val(prodi_id);
            $('#editMahasiswaForm [name=college_year]').val(college_year);
            $('#editMahasiswaForm [name=status]').val(status);
            $('#editMahasiswaModal').modal('show');
        });

        $('#editMahasiswaForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'updateMahasiswa',
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

        // Delete Mahasiswa
        $(document).ready(function() {
        // Delete Mahasiswa
        $('.delete-mahasiswa').click(function() {
            const nim = $(this).data('id'); // Use nim as the identifier
            const user_id = $(this).data('user_id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data mahasiswa akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'deleteMahasiswa',
                        type: 'POST',
                        data: {
                            mahasiswa_id: nim, // Use nim as the identifier
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
    });

        // Search Functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#mahasiswaTableBody tr').filter(function() {
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