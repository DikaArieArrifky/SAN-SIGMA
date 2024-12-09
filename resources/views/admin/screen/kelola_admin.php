<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Admin</h6>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">
                <i class="fas fa-plus"></i> Tambah Admin
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Admin...">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Photo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody">
                        <?php foreach ($data['admins'] as $index => $admin): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="editable" data-admin_id="<?= $admin['admin_id'] ?>"><?= htmlspecialchars($admin['name']) ?></td>
                                <td><?= htmlspecialchars($admin['username']) ?></td>
                                <td><?= htmlspecialchars($admin['gender']) ?></td>
                                <td><?= htmlspecialchars($admin['phone_number']) ?></td>
                                <td><img src="<?= htmlspecialchars($admin['photo']) ?>" alt="Photo" width="50"></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-admin"
                                        data-admin_id="<?= $admin['admin_id'] ?>"
                                        data-user_id="<?= $admin['user_id'] ?>"
                                        data-name="<?= htmlspecialchars($admin['name']) ?>"
                                        data-username="<?= htmlspecialchars($admin['username']) ?>"
                                        data-password="<?= htmlspecialchars($admin['password']) ?>"
                                        data-gender="<?= htmlspecialchars($admin['gender']) ?>"
                                        data-phone_number="<?= htmlspecialchars($admin['phone_number']) ?>"
                                        data-photo="<?= htmlspecialchars($admin['photo']) ?>"
                                        data-toggle="modal" data-target="#editAdminModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-admin"
                                        data-admin_id="<?= $admin['admin_id'] ?>"
                                        data-user_id="<?= $admin['user_id'] ?>">
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

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addAdminForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Admin</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="text" class="form-control" name="photo" required>
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

<!-- Edit Admin Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editAdminForm">
                <input type="hidden" name="admin_id">
                <input type="hidden" name="user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Admin</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="text" class="form-control" name="photo" required>
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
        // Add Admin
        $('#addAdminForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'createAdmin',
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

        // Edit Admin
        $(document).on('click', '.edit-admin', function() {
            const admin_id = $(this).data('admin_id');
            const user_id = $(this).data('user_id');
            const name = $(this).data('name');
            const username = $(this).data('username');
            const password = $(this).data('password');
            const gender = $(this).data('gender');
            const phone_number = $(this).data('phone_number');
            const photo = $(this).data('photo');
            $('#editAdminForm [name=admin_id]').val(admin_id);
            $('#editAdminForm [name=user_id]').val(user_id);
            $('#editAdminForm [name=name]').val(name);
            $('#editAdminForm [name=username]').val(username);
            $('#editAdminForm [name=password]').val(password);
            $('#editAdminForm [name=gender]').val(gender);
            $('#editAdminForm [name=phone_number]').val(phone_number);
            $('#editAdminForm [name=photo]').val(photo);
            $('#editAdminModal').modal('show');
        });

        $('#editAdminForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'updateAdmin',
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

        // Delete Admin
        $('.delete-admin').click(function() {
            const admin_id = $(this).data('admin_id');
            const user_id = $(this).data('user_id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data admin akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'deleteAdmin',
                        type: 'POST',
                        data: {
                            admin_id: admin_id,
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
            $('#adminTableBody tr').filter(function() {
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