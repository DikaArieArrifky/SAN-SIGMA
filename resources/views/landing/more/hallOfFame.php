<!DOCTYPE html>
<html lang="en">
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
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="<?= VENDOR; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<!-- Main CSS File -->
<link href="<?= CSS; ?>main.css" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall OF Fame</title>
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
        <a href="index" class="btn btn-primary" style="display: inline-block; padding: 10px 20px; font-size: 16px; border-radius: 5px; background: linear-gradient(45deg, #007bff, #0056b3); color: white; text-decoration: none; transition: background 0.3s ease;">
            Kembali ke Halaman Utama
        </a>
    </div>

    <h1>Daftar Skor Mahasiswa dan Dosen</h1>
    <div class="filters">
        <select id="filterOption" onchange="applyFilter()">
            <option value="all">-- Tampilkan Semua Data --</option>
            <option value="top10">Tampilkan 10 Teratas</option>
            <option value="newAll">Tampilkan Semua Penghargaan Terverifikasi Terbaru</option>
        </select>
        <select id="filterYear" onchange="applyFilter()">
            <option value="all">-- Semua Tahun --</option>
            <?php foreach ($data['years'] as $year): ?>
                <option value="<?= $year ?>">TOP 10 Mahasiswa Dan Dosen Tahun <?= $year ?></option>
            <?php endforeach; ?>
        </select>
      
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
                    <th style="padding: 20px; font-size: 1.1em;">Jurusan</th>
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

        function fetchInitialData() {
            mahasiswaOriginalData = Array.from(document.querySelectorAll('#mahasiswaTable tbody tr'));
            dosenOriginalData = Array.from(document.querySelectorAll('#dosenTable tbody tr'));
        }

        function applyFilter() {
            const filterYear = document.getElementById('filterYear').value;
            const filterOption = document.getElementById('filterOption').value;

            const mahasiswaTableBody = document.querySelector('#mahasiswaTable tbody');
            const dosenTableBody = document.querySelector('#dosenTable tbody');

            let filteredMahasiswaRows = mahasiswaOriginalData;
            let filteredDosenRows = dosenOriginalData;

            if (filterYear !== 'all') {
                filteredMahasiswaRows = filteredMahasiswaRows.filter(row => row.dataset.year === filterYear);
            }

            if (filterOption === 'top10') {
                filteredMahasiswaRows = filteredMahasiswaRows
                    .sort((a, b) => parseFloat(b.cells[3].textContent) - parseFloat(a.cells[3].textContent))
                    .slice(0, 10);

                filteredDosenRows = filteredDosenRows
                    .sort((a, b) => parseFloat(b.cells[3].textContent) - parseFloat(a.cells[3].textContent))
                    .slice(0, 10);
            }

            mahasiswaTableBody.innerHTML = '';
            filteredMahasiswaRows.forEach(row => mahasiswaTableBody.appendChild(row));

            dosenTableBody.innerHTML = '';
            filteredDosenRows.forEach(row => dosenTableBody.appendChild(row));
        }

        document.addEventListener("DOMContentLoaded", fetchInitialData);
    </script>
</body>

</html>