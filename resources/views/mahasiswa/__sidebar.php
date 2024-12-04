<link href="<?= VENDOR; ?>/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<div class="bg-gray-900 text-white w-64 flex flex-col h-screen transition-all duration-300 sidebar-expanded" id="sidebar-open">
    <div class="flex items-center justify-center h-20 border-b border-gray-800">
        <img src="<?= IMG; ?>logo_sigma.png" alt="San Sigma Logo" class="h-12">
        <span class="ml-2 text-xl font-semibold">San Sigma</span>
    </div>
    <form action="screen" method="get">
        <nav class="flex-1 px-2 py-4" id="nav-open">
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4 py-2 mt-2 text-gray-200 rounded-lg" name="screen" value="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span class="ml-3">Dashboard</span>
            </button>
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4 py-2 mt-2 text-gray-200 rounded-lg" value="inputPrestasi" name="screen">
                <i class="bi bi-folder-plus"></i>
                <span class="ml-3">Input Prestasi</span>
            </button>
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4 py-2 mt-2 text-gray-200 rounded-lg" value="riwayat" name="screen">
                <i class="fas fa-history"></i>
                <span class="ml-3">Riwayat</span>
            </button>
            <button type="submit" class="sidebar-menu-btn w-full flex items-center px-4 py-2 mt-2 text-gray-200 rounded-lg" value="profile" name="screen">
                <i class="fas fa-user"></i>
                <span class="ml-3">Profile</span>
            </button>

            <button type="button" class="sidebar-menu-btn w-full flex items-center px-4 py-2 mt-2 text-red-500 rounded-lg" id="tombol-keluar">
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
            <button type="submit" value="dashboard" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4 py-2 mt-2 text-gray-200 rounded-lg">
                <i class="fas fa-tachometer-alt"></i>
            </button>
            <button type="submit" value="inputPrestasi" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4 py-2 mt-2 text-gray-200 rounded-lg">
                <i class="bi bi-folder-plus"></i>
            </button>
            <button type="submit" value="riwayat" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4 py-2 mt-2 text-gray-200 rounded-lg">
                <i class="fas fa-history"></i>
            </button>
            <button type="submit" value="profile" name="screen" class="sidebar-menu-btn w-full flex items-center justify-center px-4 py-2 mt-2 text-gray-200 rounded-lg">
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