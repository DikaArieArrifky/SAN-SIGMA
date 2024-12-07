<header class="flex items-center justify-between px-8 py-5 bg-white border-b-[1.2px] border-gray-200">
    <div class="flex items-center">
        <button id="menu-toggle" class="text-gray-500 focus:outline-none text-2xl">
            <i class="fas fa-bars text-[1.5em]" id='sidebar-icon-open'></i>
        </button>
        <nav class="ml-6 mt-1" aria-label="Breadcrumb">
            <ol class="flex items-center text-lg text-gray-600 mt-2 ml-4">
            <li><a href="#" class="text-[15px] hover:text-gray-900">Administrator</a></li>
            <li class="mx-6 text-[15px]">/</li>
            <li class="text-[15px] font-semibold p-2"><?= $data['screen'] ?></li>
            </ol>
        </nav>
    </div>
    <div class="flex items-center">
        <button class="text-gray-500 focus:outline-none text-4xl">
            <i class="fas fa-bell"></i>
        </button>
        <div class="border-l-[2px] border-[#47b2e4] h-14 mx-8"></div>
        <div class="flex items-center">
            <img src="<?= ($data['admin']['photo']) ? IMG.'/person/'.$data['admin']['photo'] : 'https://api.dicebear.com/6.x/avataaars/svg?seed='.rand() ?>" 
                 class="w-20 h-20 rounded-full object-cover">
            <div class="ml-6 text-2xl">
                <div class="font-semibold"><?= htmlspecialchars($data['admin']['name'] ?? 'Unknown') ?></div>
                <div class="text-gray-500">user ID: <?= htmlspecialchars($data['admin']['id'] ?? '') ?></div>
            </div>
        </div>
    </div>
</header>