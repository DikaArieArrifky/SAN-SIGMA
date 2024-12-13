<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Skor Mahasiswa dan Dosen</title>
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
        select, button {
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
        select:hover, button:hover {
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
        .tables {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .table {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: center;
        }
        td {
            text-align: center;
        }
        @media (max-width: 768px) {
            .tables {
                flex-direction: column;
            }
        }
    </style>       
</head>
<body>
<div class="container">
    <!-- Tombol Kembali ke Halaman Utama -->
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="index"><button class="btn btn-primary">Kembali ke Halaman Utama</button></a>
    </div>
<div class="container">
    <h1>Daftar Skor Mahasiswa dan Dosen</h1>
    <div class="filters">
        <select id="filterOption" onchange="applyFilter()">
            <option value="all">-- Tampilkan Semua Data --</option>
            <option value="top10">Tampilkan 10 Teratas</option>
        </select>
        <select id="filterYear" onchange="applyFilter()">
            <option value="all">-- Semua Tahun --</option>
            <?php foreach ($data['years'] as $year): ?>
                <option value="<?= $year ?>">Tahun <?= $year ?></option>
            <?php endforeach; ?>
        </select>
        <button onclick="applyFilter()">Terapkan Filter</button>
    </div>

    <div class="tables">
        <!-- Daftar Mahasiswa -->
        <div class="table">
            <div class="table-header">Daftar Mahasiswa</div>
            <table id="mahasiswaTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($data['mahasiswa'] as $mahasiswa): ?>
                    <tr>
                    <td class="badge bg-gradient-primary px-3 py-2 rounded-pill me-3" style="background: linear-gradient(45deg, <?= $no == 1 ? '#FFD700, #FFA500' :  ($no == 2 ? '#C0C0C0, #D3D3D3' : ($no == 3 ? '#CD7F32, #B8860B' : '#4e54c8, #8f94fb')); ?>); width: 50px; text-align: center;"> <?= ($no++) . ($no - 1 == 1 ? 'st' : ($no -1 == 2 ? 'nd' : ($no -1 == 3 ? 'rd' : 'th'))) ?></td>
                        <td><?= $mahasiswa['name'] ?></td>
                        <td><?= $mahasiswa['jurusan'] ?></td>
                        <td><?= $mahasiswa['score'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Top 10 Dosen -->
        <div class="table">
            <div class="table-header">Top 10 Dosen</div>
            <table id="dosenTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>Jurusan</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($data['dosen'] as $dosen): ?>
                    <tr>
                        <td class="badge bg-gradient-primary px-3 py-2 rounded-pill me-3" style="background: linear-gradient(45deg, <?= $no == 1 ? '#FFD700, #FFA500' :  ($no == 2 ? '#C0C0C0, #D3D3D3' : ($no == 3 ? '#CD7F32, #B8860B' : '#4e54c8, #8f94fb')); ?>); width: 50px; text-align: center;"> <?= ($no++) . ($no - 1 == 1 ? 'st' : ($no -1 == 2 ? 'nd' : ($no -1 == 3 ? 'rd' : 'th'))) ?></td>
                        <td><?= $dosen['name'] ?></td>
                        <td><?= $dosen['jurusan'] ?></td>
                        <td><?= $dosen['score'] ?></td>
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
