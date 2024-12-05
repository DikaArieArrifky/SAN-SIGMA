<header class="flex items-center justify-between px-7 py-4 bg-white border-b border-gray-200 ">
    <div class="flex items-center">
        <button id="menu-toggle" class="text-gray-500 focus:outline-none text-xl">
            <i class="fas fa-bars text-[1.25em]" id='sidebar-icon-open'></i>
        </button>
        <nav class="ml-5" aria-label="Breadcrumb">
            <ol class="flex items-center text-base text-gray-600">
                <li><a href="#" class="hover:text-gray-900">Mahasiswa</a></li>
                <li class="mx-2">/</li>
                <li class="font-semibold"><?= $data['screen'] ?></li>
            </ol>
        </nav>
    </div>
    <div class="flex items-center">
        <button class="text-gray-500 focus:outline-none text-xl">
            <i class="fas fa-bell"></i>
        </button>
        <div class="border-l-2 border-[#47b2e4] h-8 mx-4"></div>
        <div class="flex items-center">
            <img src="<?= ($data['mahasiswa']['photo']) ? IMG.'/person/'.$data['mahasiswa']['photo'] : 'https://api.dicebear.com/6.x/avataaars/svg?seed='.rand() ?>" 
                 class="w-12 h-12 rounded-full object-cover">
            <div class="ml-3 text-base">
                <div class="font-semibold"><?= htmlspecialchars($data['mahasiswa']['name'] ?? 'Unknown') ?></div>
                <div class="text-gray-500"><?= htmlspecialchars($data['mahasiswa']['nim'] ?? '') ?></div>
            </div>
        </div>
    </div>
</header>