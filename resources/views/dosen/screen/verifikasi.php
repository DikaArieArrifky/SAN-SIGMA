<!-- create dosen verifikasi.php -->
<?php include_once VIEWS . "dosen/__dashboard.php"; 
echo "verifikasi";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Verifikasi</title>
</head>
<body>
<div class="table-container">
                <div class="search">
                    <input placeholder="Search.." type="text" />
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Nama Mahasiswa
                            </th>
                            <th>
                                Judul
                            </th>
                            <th>
                                Tempat
                            </th>
                            <th>
                                Verifikasi Dosen
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Bagas Budi Arie
                            </td>
                            <td>
                                Basket
                            </td>
                            <td>
                                Malang
                            </td>
                            <td>
                                <span class="status">
                                    Diproses
                                </span>
                            </td>
                            <td>
                                <a class="action" href="#">
                                    Cek &amp; Validasi
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Amanda The Explorer
                            </td>
                            <td>
                                PUBG
                            </td>
                            <td>
                                Malang
                            </td>
                            <td>
                                <span class="status">
                                    Diproses
                                </span>
                            </td>
                            <td>
                                <a class="action" href="#">
                                    Cek &amp; Validasi
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Heppy Asmara
                            </td>
                            <td>
                                UI/UX
                            </td>
                            <td>
                                Malang
                            </td>
                            <td>
                                <span class="status">
                                    Diproses
                                </span>
                            </td>
                            <td>
                                <a class="action" href="#">
                                    Cek &amp; Validasi
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="#">
                        Prev
                    </a>
                    <a class="active" href="#">
                        1
                    </a>
                    <a href="#">
                        2
                    </a>
                    <a href="#">
                        ...
                    </a>
                    <a href="#">
                        10
                    </a>
                    <a href="#">
                        Next
                    </a>
                </div>
            </div>
</body>
</html>