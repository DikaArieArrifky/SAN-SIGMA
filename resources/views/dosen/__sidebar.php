<link href="<?= VENDOR; ?>/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="bg-gray-900 text-white w-[20rem] flex flex-col h-screen transition-all duration-300 sidebar-expanded" id="sidebar-open">
    <div class="flex items-center justify-center h-24 border-b border-gray-800">
        <img src="<?= IMG; ?>logo_sigma.png" alt="San Sigma Logo" class="h-14">
        <span class="ml-2 text-xl font-semibold">San Sigma</span>
    </div>
    <form action="screen" method="get">
        <nav class="flex-1 px-2 py-4" id="nav-open">
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4  py-3 mt-3 text-gray-200 rounded-lg"  value="dashboard" name="screen">
                <i class="fas fa-tachometer-alt"></i>
                <span class="ml-3">Dashboard</span>
            </button>
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4  py-3 mt-3 text-gray-200 rounded-lg" value="verifikasi" name="screen">
            <i class="fas fa-check-circle"></i>
            <link rel="stylesheet" href="../screen/verifikasi.php">
            <span class="ml-3">Verifikasi</span>
                
            </button>
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4  py-3 mt-3 text-gray-200 rounded-lg" value="riwayat" name="screen">
                <i class="fas fa-history"></i>
                <span class="ml-3">Riwayat</span>
            </button>
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4  py-3 mt-3 text-gray-200 rounded-lg" value="profile" name="screen">
                <i class="fas fa-user"></i>
                <span class="ml-3">Profile</span>
            </button>

            <button type="button" class="sidebar-menu-btn w-full flex items-center px-4  py-3 mt-3 text-red-500 rounded-lg" id="tombol-keluar">
                <i class="fas fa-sign-out-alt"></i>
                <span class="ml-3">Keluar</span>
            </button>
        </nav>
    </form>

    <script>
        document.getElementById('tombol-keluar').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                // Using form submission for proper logout handling
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'logout';
                document.body.appendChild(form);
                form.submit();
            }
        });
    </script>
</div>

<div class="bg-gray-900 text-white w-28 flex flex-col h-screen transition-all duration-300 sidebar-minimized" id="sidebar-close">
    <div class="flex items-center justify-center h-20 border-b border-gray-800">
        <img src="<?= IMG; ?>logo_sigma.png" alt="San Sigma Logo" class="h-12">
    </div>
    <form action="screen" method="get">
        <nav class="flex-1 px-2 py-4 flex flex-col items-center" id="nav-close">
            <button type="submit" value="dashboard" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4  py-3 mt-3 text-gray-200 rounded-lg">
                <i class="fas fa-tachometer-alt"></i>
            </button>
            <button type="submit" value="inputPrestasi" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4  py-3 mt-3 text-gray-200 rounded-lg">
                <i class="bi bi-folder-plus"></i>
            </button>
            <button type="submit" value="riwayat" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4  py-3 mt-3 text-gray-200 rounded-lg">
                <i class="fas fa-history"></i>
            </button>
            <button type="submit" value="profile" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4  py-3 mt-3 text-gray-200 rounded-lg">
                <i class="fas fa-user"></i>
            </button>
        </nav>
    </form>

    <div class="px-4 py-2 border-t border-gray-800 flex justify-center">
        <button type="button" class="flex items-center w-full justify-center text-red-500 hover:text-red-800" id="tombol-keluar2">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </div>
    <script>
        document.getElementById('tombol-keluar2').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                // Using form submission for proper logout handling
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'logout';
                document.body.appendChild(form);
                form.submit();
            }
        });
    </script>
</div>
<style>
/* Increase all font sizes */
.sidebar-menu-btn {
    font-size: 1.5rem;
}

.sidebar-menu-btn i {
    font-size: 2rem;
}

/* Adjust sidebar widths */
.sidebar-expanded {
    width: 19.2rem; /* 120% of 16rem */
}

.sidebar-minimized {
    width: 8.4rem; /* 120% of 7rem */
}

/* Increase padding and margins */
.sidebar-menu-btn {
    padding: 0.6rem 1.2rem;
    margin-top: 0.6rem;
}
</style>