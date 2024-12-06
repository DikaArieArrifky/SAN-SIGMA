<html>

<head>
    <title>
        Input Prestasi
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e9eef1;
        }

        .content {
            padding: 20px;
        }

        .form-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-section h5 {
            background-color: #00bcd4;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin: -20px -20px 20px -20px;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="content flex-grow-1">
            <div class="form-section">
                <h5>
                    <i class="bi bi-clipboard2-plus"></i> Data Kompetisi
                </h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <strong><label class="form-label">Judul Kompetisi</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="text" name="judul" pattern="[A-Za-z0-9\s]+" maxlength="255" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Tingkat Kompetisi</label></strong>
                        <span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <select class="form-control" name="tingkat" required>
                            <option value="">Pilih Tingkat Kompetisi</option>
                            <?php foreach ($data['tingkat'] as $tingkat): ?>
                                <option value="<?= $tingkat['id'] ?>"><?= htmlspecialchars($tingkat['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Peringkat</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <select class="form-control" name="peringkat" required>
                            <option value="">Pilih Tingkat Kompetisi</option>
                            <?php foreach ($data['peringkat'] as $peringkat): ?>
                                <option value="<?= $peringkat['id'] ?>"><?= htmlspecialchars($peringkat['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Score Yang Akan Diperoleh</label></strong>
                        <input class="form-control" type="number" name="score" min="0" step="0.01" readonly />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Tempat Kompetisi</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="text" name="tempat" maxlength="255" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">URL/Link Kompetisi</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="url" name="url" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Tanggal Mulai</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="date" name="tanggal_mulai" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Tanggal Akhir</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="date" name="tanggal_akhir" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Jumlah Instansi</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="number" name="jumlah_instansi" min="1" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">Jumlah Peserta</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="number" name="jumlah_peserta" min="1" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">File Sertifikat</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="file" name="sertifikat" accept=".pdf,.jpg,.jpeg,.png" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">File Poster</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="file" name="poster" accept=".pdf,.jpg,.jpeg,.png" required />
                    </div>
                    <div class="mb-3">
                        <strong><label class="form-label">File Foto Kegiatan</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>
                        <input class="form-control" type="file" name="foto" accept=".jpg,.jpeg,.png" required />
                    </div>

            </div>
            <div class="form-section">
                <h5>
                    <i class="bi bi-clipboard2-plus"></i> Data Pembimbing
                </h5>
                <div class="mb-3">
                    <strong><label class="form-label">Pembimbing Lomba</label></strong><span class="text-danger" style="font-size: 1.2em; font-weight: bold;">*</span>

                    <select class="form-control" name="pembimbing" required>
                        <option value="">Pilih Pembimbing *</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-danger me-2">
                    Reset
                </button>
                <button class="btn btn-primary">
                    Kirim
                </button>
            </div>
        </div>
        </form>
    </div>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tingkatSelect = document.querySelector('select[name="tingkat"]');
        const peringkatSelect = document.querySelector('select[name="peringkat"]');
        const scoreInput = document.querySelector('input[name="score"]');

        // Function to calculate and update score
        function updateScore() {
            const tingkatId = tingkatSelect.value;
            const peringkatId = peringkatSelect.value;

            if (tingkatId && peringkatId) {
                // Use FormData for better data handling
                const formData = new FormData();
                formData.append('tingkat_id', tingkatId);
                formData.append('peringkat_id', peringkatId);

                fetch('calculateScore', {
                        method: 'POST',
                        body: formData

                    })

                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();

                    })
                    .then(data => {
                        if (data && typeof data.score !== 'undefined') {
                            scoreInput.value = data.score;
                        } else {
                            console.error('Invalid score data received');
                            scoreInput.value = '';
                        }
                    })
                    .catch(error => {

                        console.error('Error calculating score:', error);
                        scoreInput.value = '';


                    });


            } else {
                scoreInput.value = '';
            }
        }

        // Add event listeners
        tingkatSelect.addEventListener('change', updateScore);
        peringkatSelect.addEventListener('change', updateScore);
    });
</script>