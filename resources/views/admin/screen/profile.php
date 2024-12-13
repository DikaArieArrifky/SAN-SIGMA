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
        background-color: #f0f4f8;
    }

    .container {
        display: flex;
        height: 100vh;
    }

    .main-content {
        flex-grow: 1;

        padding: 20px;
    }

    .main-content .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .main-content .header .breadcrumb {
        font-size: 14px;
        color: #555;

    }

    .main-content .header .user-info {
        display: flex;
        align-items: center;
    }

    .main-content .header .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .main-content .header .user-info .name {
        font-weight: 500;
    }

    .main-content .header .user-info .id {
        font-size: 12px;
        color: #888;
    }

    .main-content .profile-section {
        /* make the profile-secion width and height as dekstop */

        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
    }

    .main-content .profile-section .profile-menu {
        width: 200px;
        margin-right: 20px;
        border-right: 1px solid #ccc;
        padding-right: 20px;
    }

    .main-content .profile-section .profile-menu ul {
        list-style: none;
        padding: 0;
    }

    .main-content .profile-section .profile-menu ul li {
        padding: 10px 15px;
        cursor: pointer;
        background-color: #f0f4f8;
        margin-bottom: 10px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .main-content .profile-section .profile-menu ul li:hover,
    .main-content .profile-section .profile-menu ul li.active {
        background-color: #007bff;
        color: #fff;
    }

    .main-content .profile-section .profile-content {
        flex-grow: 1;
        padding-left: 20px;
    }

    .main-content .profile-section .profile-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        position: relative;
    }

    .main-content .profile-section .profile-header img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 20px;
    }

    .main-content .profile-section .profile-header .edit-icon {
        position: absolute;
        bottom: -10px;
        right: calc(50% - 40px);
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        padding: 5px;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .main-content .profile-section .profile-header .edit-icon:hover {
        background-color: #0056b3;
    }

    .main-content .profile-section .profile-header .profile-title {
        font-size: 24px;
        font-weight: 500;
        position: absolute;
        left: 0;
        transform: translateX(-100%);
    }

    .main-content .profile-section .profile-form {
        display: flex;
        flex-direction: column;
    }

    .main-content .profile-section .profile-form label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .main-content .profile-section .profile-form input {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .submit-pw {
        background-color: #4299e1;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 150px;
        align-items: right;
    }

    .submit-pw:hover {
        background-color: #2b6cb0;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="profile-section">
                <div class="profile-menu">
                    <ul style="text-align: left;">
                        <li class="active">
                            <i class="fas fa-user" style="font-size: 1.2em;">
                            </i>
                            <span style="font-size: 1.2em;">Profile</span>
                        </li>
                        <li style="background: none; border: none; cursor: pointer; font-size: 1.2em; display: flex; align-items: center; background-color: #f0f4f8; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" data-toggle="modal" data-target="#modal-pw" type="buton">
                            <i class="fas fa-lock" style="font-size: 1.2em; color: #007bff;  align-items: left"></i>
                            <span style="font-size: 1.2em; margin-left: 5px; color: #007bff;">Password</span>
                        </li>
                    </ul>

                </div>
                <form action="uploadPhoto" method="post" enctype="multipart/form-data" class="profile-content">
                    <div class="profile-header">
                        <div class="profile-title" style="
                            margin-left: 145px;
                            font-size: 28px;
                            font-weight: 600;
                            color: #2d3748;
                            text-transform: uppercase;
                            letter-spacing: 1px;
                            padding-bottom: 5px;
                            border-bottom: 3px solid #4299e1;
                            display: inline-block;
                        ">
                            Biodata
                        </div>
                        <img alt="Profile Picture" height="80"
                            src="<?= ($data['admin']['photo']) ? IMG . '/person/' . $data['admin']['photo'] : 'https://api.dicebear.com/6.x/avataaars/svg?seed=' . rand() ?>"
                            width="80" onclick="window.open(this.src, '_blank')" />
                        <label for="photo-upload" class="edit-icon" style="cursor: pointer;">
                            <i class="fas fa-edit"></i>
                        </label>
                        <input type="file"
                            id="photo-upload"
                            name="photo"
                            accept="image/*"
                            style="display: none;"
                            onchange="this.form.submit()">
                        <input type="hidden" name="id" value="<?= $data['admin']['id'] ?>">
                    </div>

                    <div class="profile-content">

                        <div class="profile-form ">
                            <label for="nama-admin">
                                Nama admin
                            </label>
                            <input id="nama-admin" readonly="" type="text" value="<?= $data['admin']['name'] ?>">

                          

                            <label for="gender">
                                Jenis Kelamin
                            </label>
                            <input id="gender" readonly="" type="text" value="<?= ($data['admin']['gender'] ?? '') === 'L' ? 'Laki-Laki' : 'Perempuan' ?>">

                           
                            <label for="no-telepon">
                                No. Telepon
                            </label>
                            <input id="no-telepon" readonly="" type="text" value="<?= htmlspecialchars($data['admin']['phone_number'] ?? '') ?>">
                           
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>
</body>
<style>
    .profile-title {
        font-size: 28px;
        font-weight: 600;
        color: #2d3748;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 5px;
        border-bottom: 3px solid #4299e1;
        display: inline-block;
        margin-bottom: 15px;
    }
</style>

<div id="modal-pw" class="modal fade" role="dialog">

    <div class="container">
        <div class="main-content">
            <div class="profile-section">

                <div class="profile-content">
                    <div class="profile-title">
                        Ganti Password
                    </div>
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 30px; margin: 10px;">&times;</button>
                    <div class="profile-form">
                        <form action="changePassword" method="post" class="profile-form">
                            <label for="password-lama ">
                                Masukan Password Lama <span style="color: red;">*</span>
                            </label>
                            <input id="password-lama" type="password" name="password-lama"
                                placeholder="**********" required>

                            <div class="password-baru">
                                <hr style="border-color: #4299e1; border-width: 3px;">
                            </div>

                            <label for="password-baru">
                                Masukan Password Baru <span style="color: red;">*</span>
                            </label>
                            <input id="password-baru" type="password" name="password-baru"
                                placeholder="**********" required>

                            <label for="password-baru-verif">
                                Ulangi Password <span style="color: red;">*</span>
                            </label>
                            <input id="password-baru-verif" type="password" name="password-baru-verif"
                                placeholder="**********" required>

                            <?php
                            // Anti-injection
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $passwordLama = htmlspecialchars($_POST['password-lama'], ENT_QUOTES, 'UTF-8');
                                $passwordBaru = htmlspecialchars($_POST['password-baru'], ENT_QUOTES, 'UTF-8');
                                $passwordBaruVerif = htmlspecialchars($_POST['password-baru-verif'], ENT_QUOTES, 'UTF-8');
                            }
                            ?>

                            <button type="submit" class="submit-pw">Ganti Password</button>

                            <?php if (isset($_GET['error'])): ?>
                                <div class="error-message" style="color: red; margin-top: 10px;">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_GET['message'])): ?>
                                <div class="success-message" style="color: green; margin-top: 10px;">
                                    <?= htmlspecialchars($_GET['message']) ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add SweetAlert2 CDN in head section -->


<!-- Replace PHP messages with JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const message = urlParams.get('message');

        // Show error popup
        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error,
                confirmButtonColor: '#d33',
                timer: 3000
            });
        }

        // Show success popup
        if (message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                confirmButtonColor: '#3085d6',
                timer: 3000
            });
        }

        // Clear URL parameters after showing popup
        if (error || message) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>