<?php
require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';

$db = Database::getInstance(getDatabaseConfig(), [$this, 'error']);
$mahasiswaModel = new Mahasiswa($db);

$mahasiswa = $mahasiswaModel->getMahasiswaByUserId($_SESSION['user_id']);
$mahasiswa['prodi'] = $mahasiswaModel->getProdiNameByMahasiswaProdiId($mahasiswa['prodi_id']);
$mahasiswa['count'] = $mahasiswaModel->getMahasiswaByNim($mahasiswa['nim']);
$mahasiswa['countTerverifikasi'] = $mahasiswaModel->getMahasiswaTerverifikasiByNim($mahasiswa['nim']);
$mahasiswa['rank'] = $mahasiswaModel->getRankNoMahasiswa($mahasiswa['nim']);
$haveScore['count'] = $mahasiswaModel->getMahasiswaWhoHaveScore();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucwords($data['screen'] ?? 'Dashboard') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS; ?>/sidebar_style.css">
    <link rel="stylesheet" href="<?= VENDOR; ?>/bootstrap/css/bootstrap-grid.css">
    <link href="<?= IMG; ?>/logo_sigma.png" rel="icon">
    
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar-container">
        <?php include_once VIEWS . "mahasiswa/__sidebar.php"; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <div id="header">
            <?php include_once VIEWS . "mahasiswa/__header.php"; ?>
            </div>

            <!-- Dashboard Content -->
            <main class="flex-1 p-6 bg-gray-100">
            <?php include_once VIEWS . "mahasiswa/screen/".$data['screen'].".php"; ?>

            </main>
        </div>
    </div>
    <script src="<?= JS; ?>/jquery-3.7.1.js"></script>
    <script src="<?= JS; ?>/sidebar_script.js"></script>
</body>
</html>

