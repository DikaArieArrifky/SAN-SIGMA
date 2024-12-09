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
        .tables {
            display: flex;
            gap: 20px;
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
    </style>       
</head>
<body>
<div class="container">
<div style="text-align: center; margin-bottom: 20px;">
    <label for="filterOption">Filter Data:</label>
    <select id="filterOption" onchange="applyFilter()">
        <option value="all">-- Tampilkan Semua Data --</option>
        <option value="top10">Tampilkan 10 Teratas</option>
    </select>
</div>

    <h1>Daftar Skor Mahasiswa dan Dosen</h1>
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
                            <td><?= $no++; ?></td>
                            <td><?= $mahasiswa['name']; ?></td>
                            <td><?= $mahasiswa['jurusan']; ?></td>
                            <td><?= $mahasiswa['score']; ?></td>
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
                            <td><?= $no++; ?></td>
                            <td><?= $dosen['name']; ?></td>
                            <td><?= $dosen['jurusan']; ?></td>
                            <td><?= $dosen['score']; ?></td>
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

// Simulasi mengambil data dari tabel untuk semua mahasiswa dan dosen.
function fetchInitialData() {
    mahasiswaOriginalData = Array.from(document.querySelectorAll('#mahasiswaTable tbody tr'));
    dosenOriginalData = Array.from(document.querySelectorAll('#dosenTable tbody tr'));
}

// Fungsi untuk menerapkan filter berdasarkan dropdown
function applyFilter() {
    const filterOption = document.getElementById('filterOption').value;

    const mahasiswaTableBody = document.querySelector('#mahasiswaTable tbody');
    const dosenTableBody = document.querySelector('#dosenTable tbody');

    if (filterOption === "top10") {
        // Filter untuk Top 10 Mahasiswa berdasarkan skor tertinggi
        const top10Mahasiswa = mahasiswaOriginalData
            .sort((a, b) => parseFloat(b.cells[3].textContent) - parseFloat(a.cells[3].textContent))
            .slice(0, 10);
        
        const top10Dosen = dosenOriginalData
            .sort((a, b) => parseFloat(b.cells[3].textContent) - parseFloat(a.cells[3].textContent))
            .slice(0, 10);

        // Bersihkan tabel sebelum mengisi data filter
        mahasiswaTableBody.innerHTML = '';
        dosenTableBody.innerHTML = '';

        top10Mahasiswa.forEach(row => mahasiswaTableBody.appendChild(row));
        top10Dosen.forEach(row => dosenTableBody.appendChild(row));
    } else if (filterOption === "all") {
        // Jika pengguna memilih "Tampilkan Semua Data", kembalikan data asli
        mahasiswaTableBody.innerHTML = '';
        dosenTableBody.innerHTML = '';

        mahasiswaOriginalData.forEach(row => mahasiswaTableBody.appendChild(row));
        dosenOriginalData.forEach(row => dosenTableBody.appendChild(row));
    }
}

// Jalankan fetch data saat halaman dimuat
document.addEventListener("DOMContentLoaded", fetchInitialData);

</script>
</body>


</html>
