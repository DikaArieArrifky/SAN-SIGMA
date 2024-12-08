<!-- create dosen dashboard.php -->
<div class="content-wrapper">
    <div class="row">
        <!-- Unverified Awards Card -->
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                        Penghargaan Yang Belum Di Verifikasi 
                        <i class="bi bi-clipboard" style="font-size: 24px;"></i>
                    </h4>
                    <h1 class="mb-2" style="font-size: 4em;">
                        <?= $data['dosen']['count']['count'] ?? '0' ?>
                    </h1>
                    <h6 class="card-text">
                        <a href="?screen=riwayat" class="text-white">Lihat Semua Permintaan</a>
                    </h6>
                </div>
            </div>
        </div>

        <!-- Verified Awards Card -->
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                        Sudah Terverifikasi 
                        <i class="bi bi-clipboard-check" style="font-size: 24px;"></i>
                    </h4>
                    <h1 class="mb-2" style="font-size: 4em;">
                        <?= $data['dosen']['countTerverifikasi']['count'] ?? '0' ?>
                    </h1>
                    <h6 class="card-text">
                        <a href="?screen=riwayat" class="text-white">Lihat Semua Permintaan</a>
                    </h6>
                </div>
            </div>
        </div>

        <!-- Total Score Card -->
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                        Total Score 
                        <i class="bi bi-trophy" style="font-size: 24px;"></i>
                    </h4>
                    <h1 class="mb-2" style="font-size: 4em;">
                        <?= $data['dosen']['score'] ?? '0' ?>
                    </h1>
                    <h6 class="card-text">
                        Tetap Teruskan Perjuangan Anda
                    </h6>
                </div>
            </div>
        </div>

        <!-- Ranking Card -->
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="<?= IMG; ?>/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-1" style="font-size: 1.5em;">
                        Ranking 
                        <i class="bi bi-trophy" style="font-size: 24px;"></i>
                    </h4>
                    <h1 class="mb-2" style="font-size: 4em;">
                        <?= $data['dosen']['rank']['dense_rank'] ?? '-' ?>
                    </h1>
                    <h6 class="card-text">
                        Dari <?= $data['haveScore']['count']['count'] ?? '0' ?> Dosen Berprestasi
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>