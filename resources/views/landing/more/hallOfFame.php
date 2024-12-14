<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Hall OF Fame SAN SIGMA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= IMG; ?>/logo_sigma.png" rel="icon">
    <link href="<?= IMG; ?>/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= VENDOR; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= CSS; ?>main.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        select,
        button {
            font-size: 16px;
            padding: 10px 15px;
            border: 2px solid #007bff;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        select {
            appearance: none;
            background-color: #fff;
            color: #007bff;
        }

        select:hover,
        button:hover {
            background-color: #007bff;
            color: white;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="index" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; font-size: 16px; border-radius: 8px; background: linear-gradient(45deg, #007bff, #0056b3); color: white; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            Kembali
        </a>
    </div>
    <div class="glory-header" style="text-align: center; margin: 40px 0; padding: 20px; 
        background: linear-gradient(135deg, #ffd700, #ffc107, #ffeb3b);
        border-radius: 20px; 
        box-shadow: 0 15px 40px rgba(255, 193, 7, 0.5),
                   inset 0 0 30px rgba(255, 255, 255, 0.5);
        position: relative;
        overflow: hidden;">


        <h1 style="font-family: 'Poppins', sans-serif; 
            font-size: 4em; 
            color: white;
            text-transform: uppercase; 
            letter-spacing: 4px; 
            margin: 0;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.3),
                         -1px -1px 2px rgba(255,255,255,0.3);
            position: relative;">
            ✨ Hall Of Fame ✨
        </h1>

        <p style="color: #fff; 
            font-size: 1.4em; 
            margin-top: 15px;
            font-weight: 300;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            position: relative;">
            Celebrating Excellence and Outstanding Achievements
        </p>

        <div style="width: 120px; 
            height: 4px; 
            background: linear-gradient(to right, transparent, white, transparent);
            margin: 20px auto;
            border-radius: 2px;
            position: relative;"></div>
    </div>
    <div class="filters">
        <select id="filterOption" onchange="applyFilter()">
            <option value="all">-- Tampilkan Semua Data --</option>
            <option value="top10">Tampilkan 10 Teratas</option>
            <option value="recentVerifData">Tampilkan Semua Penghargaan Terverifikasi Terbaru</option>
            <?php foreach ($data['years'] as $year): ?>
                <option value="<?= $year ?>">TOP 10 Mahasiswa Dan Dosen Tahun <?= $year ?></option>
            <?php endforeach; ?>
        </select>
        <button onclick="resetFilter()">Reset Filter</button>
    </div>

    <div class="tables" style="display: flex; justify-content: space-between; gap: 20px;">
        <!-- Daftar Mahasiswa (Left) -->
        <div class="table" style="flex: 1; width: 48%; margin: 10px;">
            <div class="table-header" style="background: linear-gradient(135deg, #1e88e5, #1565c0); color: white; padding: 20px; border-radius: 15px 15px 0 0; font-size: 1.3em; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Daftar Mahasiswa</div>
            <div class="table-responsive" style="box-shadow: 0 10px 30px rgba(0,0,0,0.15); border-radius: 0 0 15px 15px; background: white;">
                <table id="mahasiswaTable" class="table table-hover">
                    <thead style="background: linear-gradient(135deg, #2196f3, #1976d2); color: white;">
                        <tr>
                            <th style="padding: 20px; font-size: 1.1em;">No</th>
                            <th style="padding: 20px; font-size: 1.1em;">Nama Mahasiswa</th>
                            <th style="padding: 20px; font-size: 1.1em;">Program Studi</th>
                            <th style="padding: 20px; font-size: 1.1em;">Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data['mahasiswa'] as $mahasiswa): ?>
                            <tr style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor=''">
                                <td class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, <?= $no == 1 ? '#ffd700, #ffa500' : ($no == 2 ? '#e0e0e0, #bdbdbd' : ($no == 3 ? '#cd7f32, #8d6e63' : '#4e54c8, #8f94fb')); ?>); color: white; width: 60px; text-align: center; font-size: 1em; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    <?= ($no++) . ($no - 1 == 1 ? 'st' : ($no - 1 == 2 ? 'nd' : ($no - 1 == 3 ? 'rd' : 'th'))) ?>
                                </td>
                                <td style="padding: 20px; font-weight: 500;"><?= $mahasiswa['name'] ?></td>
                                <td style="padding: 20px;"><?= $mahasiswa['jurusan'] ?></td>
                                <td style="padding: 20px; font-weight: bold; color: #1e88e5;"><?= $mahasiswa['score'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top 10 Dosen (Right) -->
        <div class="table" style="flex: 1; width: 48%; margin: 10px;">
            <div class="table-header" style="background: linear-gradient(135deg, #1e88e5, #1565c0); color: white; padding: 20px; border-radius: 15px 15px 0 0; font-size: 1.3em; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Top 10 Dosen</div>
            <div class="table-responsive" style="box-shadow: 0 10px 30px rgba(0,0,0,0.15); border-radius: 0 0 15px 15px; background: white;">
                <table id="dosenTable" class="table table-hover">
                    <thead style="background: linear-gradient(135deg, #2196f3, #1976d2); color: white;">
                        <tr>
                            <th style="padding: 20px; font-size: 1.1em;">No</th>
                            <th style="padding: 20px; font-size: 1.1em;">Nama Dosen</th>
                            <th style="padding: 20px; font-size: 1.1em;">Home Base</th>
                            <th style="padding: 20px; font-size: 1.1em;">Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data['dosen'] as $dosen): ?>
                            <tr style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor=''">
                                <td class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, <?= $no == 1 ? '#ffd700, #ffa500' : ($no == 2 ? '#e0e0e0, #bdbdbd' : ($no == 3 ? '#cd7f32, #8d6e63' : '#4e54c8, #8f94fb')); ?>); color: white; width: 60px; text-align: center; font-size: 1em; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    <?= ($no++) . ($no - 1 == 1 ? 'st' : ($no - 1 == 2 ? 'nd' : ($no - 1 == 3 ? 'rd' : 'th'))) ?>
                                </td>
                                <td style="padding: 20px; font-weight: 500;"><?= $dosen['name'] ?></td>
                                <td style="padding: 20px;"><?= $dosen['jurusan'] ?></td>
                                <td style="padding: 20px; font-weight: bold; color: #1e88e5;"><?= $dosen['score'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let mahasiswaOriginalData = [];
        let dosenOriginalData = [];
        let newAllVerifikasiData = <?php echo json_encode($data['newAllVerifikasi']); ?>;
        let top10MahasiswaData = <?php echo json_encode($data['top10mahasiswas']); ?>;
        let top10DosenData = <?php echo json_encode($data['top10dosen']); ?>;

        // Fetch initial data when page loads
        window.onload = fetchInitialData;

        function fetchInitialData() {
            mahasiswaOriginalData = Array.from(document.querySelectorAll('#mahasiswaTable tbody tr'));
            dosenOriginalData = Array.from(document.querySelectorAll('#dosenTable tbody tr'));

        }

        function resetFilter() {
            const filterOption = document.getElementById('filterOption');
            filterOption.value = 'all';

            const mahasiswaTableBody = document.querySelector('#mahasiswaTable tbody');
            const dosenTableBody = document.querySelector('#dosenTable tbody');

            mahasiswaTableBody.innerHTML = '';
            dosenTableBody.innerHTML = '';

            mahasiswaOriginalData.forEach(row => mahasiswaTableBody.appendChild(row.cloneNode(true)));
            dosenOriginalData.forEach(row => dosenTableBody.appendChild(row.cloneNode(true)));
        }

        function createTableRow(item, index) {
            const row = document.createElement('tr');
            row.setAttribute('style', 'transition: all 0.3s ease; cursor: pointer;');
            row.setAttribute('onmouseover', "this.style.backgroundColor='#f8f9fa'");
            row.setAttribute('onmouseout', "this.style.backgroundColor=''");

            row.innerHTML = `
                <td class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, ${index < 3 ? ['#ffd700, #ffa500', '#e0e0e0, #bdbdbd', '#cd7f32, #8d6e63'][index] : '#4e54c8, #8f94fb'}); color: white; width: 60px; text-align: center; font-size: 1em; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    ${index + 1}${['st', 'nd', 'rd', 'th'][index < 3 ? index : 3]}
                </td>
                <td style="padding: 20px; font-weight: 500;">${item.name}</td>
                <td style="padding: 20px;">${item.jurusan}</td>
                <td style="padding: 20px; font-weight: bold; color: #1e88e5;">${item.score}</td>
            `;
            return row;
        }

        function updateTables(mahasiswaData, dosenData) {
            const mahasiswaTableBody = document.querySelector('#mahasiswaTable tbody');
            const dosenTableBody = document.querySelector('#dosenTable tbody');

            mahasiswaTableBody.innerHTML = '';
            dosenTableBody.innerHTML = '';

            mahasiswaData.forEach((item, index) => {
                const row = createTableRow(item, index);
                mahasiswaTableBody.appendChild(row);
            });

            dosenData.forEach((item, index) => {
                const row = createTableRow(item, index);
                dosenTableBody.appendChild(row);
            });
        }

        function applyFilter() {
            const filterOption = document.getElementById('filterOption').value;

            if (filterOption === 'all') {
                resetFilter();
                return;
            }

            if (filterOption === 'top10') {
                updateTables(top10MahasiswaData, top10DosenData);
            } else if (filterOption === 'recentVerifData') {
                let mahasiswaTableBody = document.querySelector('#mahasiswaTable tbody');
                let dosenTableBody = document.querySelector('#dosenTable tbody');

                // Clear existing tables
                mahasiswaTableBody.innerHTML = '';
                dosenTableBody.innerHTML = '';

                // Update table headers for both tables
                document.querySelector('#mahasiswaTable thead tr').innerHTML = `
                <th style="padding: 20px; font-size: 1.1em;">No</th>
                <th style="padding: 20px; font-size: 1.1em;">Nama</th>
                <th style="padding: 20px; font-size: 1.1em;">Judul</th>
                <th style="padding: 20px; font-size: 1.1em;">Tingkatan</th>
            `;
                document.querySelector('#dosenTable thead tr').innerHTML = `
                <th style="padding: 20px; font-size: 1.1em;">No</th>
                <th style="padding: 20px; font-size: 1.1em;">Nama</th>
                <th style="padding: 20px; font-size: 1.1em;">Judul</th>
                <th style="padding: 20px; font-size: 1.1em;">Tingkatan</th>
            `;

                // Display verification data
                newAllVerifikasiData.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.setAttribute('style', 'transition: all 0.3s ease; cursor: pointer;');
                    row.setAttribute('onmouseover', "this.style.backgroundColor='#f8f9fa'");
                    row.setAttribute('onmouseout', "this.style.backgroundColor=''");

                    row.innerHTML = `
                    <td class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, ${index < 3 ? ['#ffd700, #ffa500', '#e0e0e0, #bdbdbd', '#cd7f32, #8d6e63'][index] : '#4e54c8, #8f94fb'}); color: white; width: 60px; text-align: center; font-size: 1em; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        ${index + 1}${['st', 'nd', 'rd', 'th'][index < 3 ? index : 3]}
                    </td>
                    <td style="padding: 20px; font-weight: 500;">${item.mahasiswa_name}</td>
                    <td style="padding: 20px;">${item.judul}</td>
                    <td style="padding: 20px; font-weight: bold; color: #1e88e5;">${item.tingkatan_name}</td>
                `;

                    mahasiswaTableBody.appendChild(row.cloneNode(true));
                });
            } else if (!isNaN(filterOption)) { 
                // Get year data that was pre-loaded from PHP
                const yearData = <?php 
                    $yearData = [];
                    foreach ($data['years'] as $year) {
                        $yearData[$year] = [
                            'mahasiswa' => $data['landing']->getTop10MahasiswaByYear($year),
                            'dosen' => $data['landing']->getTop10DosenByYear($year)
                        ];
                    }
                    echo json_encode($yearData);
                ?>;
                
                const selectedYearData = yearData[filterOption];
                
                if (selectedYearData) {
                    // Get table references
                    const mahasiswaTableBody = document.querySelector('#mahasiswaTable tbody');
                    const dosenTableBody = document.querySelector('#dosenTable tbody');

                    // Clear existing data
                    mahasiswaTableBody.innerHTML = '';
                    dosenTableBody.innerHTML = '';

                    // Update table headers for year-specific view
                    document.querySelector('#mahasiswaTable thead tr').innerHTML = `
                        <th style="padding: 20px; font-size: 1.1em;">No</th>
                        <th style="padding: 20px; font-size: 1.1em;">Nama</th>
                        <th style="padding: 20px; font-size: 1.1em;">Program Studi</th>
                        <th style="padding: 20px; font-size: 1.1em;">Skor Tahun ${filterOption}</th>
                    `;
                    document.querySelector('#dosenTable thead tr').innerHTML = `
                        <th style="padding: 20px; font-size: 1.1em;">No</th>
                        <th style="padding: 20px; font-size: 1.1em;">Nama</th>
                        <th style="padding: 20px; font-size: 1.1em;">Program Studi</th>
                        <th style="padding: 20px; font-size: 1.1em;">Skor Tahun ${filterOption}</th>
                    `;

                    // Populate table with year-specific data
                    selectedYearData.mahasiswa.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.setAttribute('style', 'transition: all 0.3s ease; cursor: pointer;');
                        row.setAttribute('onmouseover', "this.style.backgroundColor='#f8f9fa'");
                        row.setAttribute('onmouseout', "this.style.backgroundColor=''");

                        row.innerHTML = `
                            <td class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, ${index < 3 ? ['#ffd700, #ffa500', '#e0e0e0, #bdbdbd', '#cd7f32, #8d6e63'][index] : '#4e54c8, #8f94fb'}); color: white; width: 60px; text-align: center; font-size: 1em; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                ${index + 1}${['st', 'nd', 'rd', 'th'][index < 3 ? index : 3]}
                            </td>
                            <td style="padding: 20px; font-weight: 500;">${item.mahasiswa_name}</td>
                            <td style="padding: 20px;">${item.prodi_name}</td>
                            <td style="padding: 20px; font-weight: bold; color: #1e88e5;">${item.total_score}</td>
                        `;

                        mahasiswaTableBody.appendChild(row);
                    });

                    selectedYearData.dosen.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.setAttribute('style', 'transition: all 0.3s ease; cursor: pointer;');
                        row.setAttribute('onmouseover', "this.style.backgroundColor='#f8f9fa'");
                        row.setAttribute('onmouseout', "this.style.backgroundColor=''");

                        row.innerHTML = `
                            <td class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, ${index < 3 ? ['#ffd700, #ffa500', '#e0e0e0, #bdbdbd', '#cd7f32, #8d6e63'][index] : '#4e54c8, #8f94fb'}); color: white; width: 60px; text-align: center; font-size: 1em; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                ${index + 1}${['st', 'nd', 'rd', 'th'][index < 3 ? index : 3]}
                            </td>
                            <td style="padding: 20px; font-weight: 500;">${item.dosen_name}</td>
                            <td style="padding: 20px;">${item.prodi_name}</td>
                            <td style="padding: 20px; font-weight: bold; color: #1e88e5;">${item.total_score}</td>
                        `;

                        dosenTableBody.appendChild(row);
                    });
                }
            }
        }
    </script>
</body>

</html> 