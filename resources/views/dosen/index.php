<?php
require_once 'app/models/Dosen.php';
require_once 'app/core/Database.php';

$db = Database::getInstance(getDatabaseConfig(), [$this, 'error']);
$dosenModel = new Dosen($db);

$dosen = $dosenModel->getdosenByUserId($_SESSION['user_id']);
// $dosen['prodi'] = $dosenModel->getProdiNameBydosenProdiId($dosen['prodi_id']);
$dosen['count'] = $dosenModel->getdosenByNip($dosen['nip']);
$dosen['countTerverifikasi'] = $dosenModel->getdosenTerverifikasiByNip($dosen['nip']);
$dosen['rank'] = $dosenModel->getRankNodosen($dosen['nip']);
$haveScore['count'] = $dosenModel->getdosenWhoHaveScore();
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
    <link href="<?= IMG; ?>/logo_sigma.png" rel="icon">
</head>
<body class="bg-gray-100 font-sans antialiased">

    

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar-container">
        <?php include_once VIEWS . "dosen/__sidebar.php"; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <div id="header">
            <?php include_once VIEWS . "dosen/__header.php"; ?>
            </div>

            <!-- Dashboard Content -->
            <main class="flex-1 p-6 bg-gray-100">
            <?php include_once VIEWS . "dosen/screen/".$data['screen'].".php"; ?>

            </main>
        </div>
    </div>
    <script src="<?= JS; ?>/sidebar_script.js"></script>
    <script src="<?= JS; ?>/jquery-3.7.1.js"></script>
</body>
</html>

