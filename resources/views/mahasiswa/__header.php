<?php
require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';

$db = Database::getInstance(getDatabaseConfig(), [$this, 'error']);
$mahasiswaModel = new Mahasiswa($db);

$mahasiswa = $mahasiswaModel->getMahasiswaByUserId($_SESSION['user_id']);
$mahasiswa['prodi'] = $mahasiswaModel->getProdiNameByMahasiswaProdiId($mahasiswa['prodi_id']);
?>
<header class="flex items-center justify-between px-7 py-5 bg-white border-b border-gray-200 ">
    <div class="flex items-center">
        <button id="menu-toggle" class="text-gray-500 focus:outline-none text-xl">
            <i class="fas fa-bars text-[1.25em]" id='sidebar-icon-open'></i>
           
        </button>
        <nav class="ml-5" aria-label="Breadcrumb">
            <ol class="flex items-center text-base text-gray-600">
                <li><a href="#" class="hover:text-gray-900">Mahasiswa</a></li>
                <li class="mx-2">/</li>
                <li class="font-semibold"><?= $data['screen']?></li>
            </ol>
        </nav>
    </div>
    <div class="flex items-center">
        <button class="text-gray-500 focus:outline-none text-xl">
            <i class="fas fa-bell"></i>
        </button>
        <div class="border-l-2 border-[#47b2e4] h-8 mx-4"></div>
        <div class="flex items-center">
            <img src="<?= IMG; ?>logo_sigma.png" class="w-12 h-12 rounded-full object-cover">
            <div class="ml-3 text-base">
                <div class="font-semibold"> <?= $mahasiswa['name'] ?></div>
                <div class="text-gray-500"><?= $mahasiswa['nim'] ?></div>
            </div>
        </div>
    </div>
</header>