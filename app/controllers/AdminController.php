<?php

require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';
require_once 'app/models/Login.php';
require_once 'app/models/Admin.php';
require_once 'app/models/Prodi.php';
require_once 'app/models/Tingkatan.php';
require_once 'app/models/Peringkat.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    private $admin;
    private $prodi;
    private $tingkatan;
    private $peringkat;



    public function __construct()
    {
        $this->admin = new Admin(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->prodi = new Prodi(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->tingkatan = new Tingkatan(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->peringkat = new Peringkat(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
    }

    public function index($screen = "dashboard")
    {
        $title = $screen;
        if (strpos($title, '/') !== false) {
            $title = explode('/', $title);
            $title = array_pop($title);
            $title = str_replace('_', ' ', $title);
            $title = ucwords($title);
        }

        try {
            // Fetch admin data from database by user_id
            $dataAdmin = $this->admin->getAdminByUserId($_SESSION['user_id']);
            $chartTingakatanPrestasi = $this->admin->getCountNameTingkatanPenghargaanByVerifTerverifikasi();
            $chartAngkatanPrestasi = $this->admin->getCountAngkatanMahasiswa();
            $chartTahunVerifikasi = $this->admin->getCountTahunVerif();
            $prodis = $this->prodi->getAll();
            $tingkatans = $this->tingkatan->getAll();
            $peringkats = $this->peringkat->getAll();

            if (!$dataAdmin) {
                throw new Exception("Admin not found");
            }
            $data = [
                "screen" => $screen,
                "title" => $this->processTitle($screen),
                'dataAdmin' => $dataAdmin,
                "admin" => [
                    "name" => $dataAdmin['name'],
                    "id" => $dataAdmin['id'],
                    "photo" => $dataAdmin['photo']
                ],
                "verifikasiPenghargaan" => $this->admin->getAllVerifikasiAndPenghargaan(),
                "verifikasiPenghargaanOv" => $this->admin->getAllVerifikasiAndPenghargaanOv(),
                "countAllPenghargaan" => $this->admin->getCountAllPenghargaan(),
                "countAllVerifiedPenghargaan" => $this->admin->getAllCountVerifiedPenghargaan(),
                "countAllNotVerifiedPenghargaan" => $this->admin->getAllCountNotVerifiedPenghargaan(),


                "chartTingakatan" => [
                    'labels' => $chartTingakatanPrestasi['labels'],
                    'datasets' => [
                        [

                            'data' => $chartTingakatanPrestasi['counts']
                        ]
                    ]
                ],

                "chartAngkatan" => [
                    'labels' => $chartAngkatanPrestasi['labels'],
                    'datasets' => [
                        [
                            'data' => $chartAngkatanPrestasi['counts']
                        ]
                    ]
                ],

                "chartTahunVerification" => [
                    'labels' => $chartTahunVerifikasi['labels'],
                    'datasets' => [
                        [
                            'data' => $chartTahunVerifikasi['counts']
                        ]
                    ]
                ],
                "prodis" => $prodis,
                "tingkatans" => $tingkatans,
                "peringkats" => $peringkats


            ];
            $this->view('admin/index', $data);
        } catch (Exception $e) {
            // Handle error appropriately
            //alert js exception
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
            exit();
        }
    }

    private function processTitle($screen)
    {
        $title = $screen;
        if (strpos($title, '/') !== false) {
            $title = explode('/', $title);
            $title = array_pop($title);
            $title = str_replace('_', ' ', $title);
            $title = ucwords($title);
        }
        return $title;
    }

    public function screen()
    {
        if (isset($_GET['screen'])) {
            $screen = strtolower($_GET['screen']);
            $this->index($screen);
        }
    }
    public function getVerifikasiDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            try {
                $verifikasiId = $_POST['id'];
                $detail = $this->admin->getVerifikasiAndPenghargaanByIdVerifikasi($verifikasiId);
                echo json_encode($detail);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }
    // tombol dari admin untuk verifikasi prestasi
    public function verifikasi_prestasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $verifikasiId = $_POST['pengId'];
                $status = $_POST['verification_status'] === 'accept' ? 'Terverifikasi' : 'DiTolak';
                $pesan = $_POST['pesan'];
                $id_admin = $_POST['id_admin'];


                // Update verification status
                $result = $this->admin->updateVerification($verifikasiId, $status, $pesan, $id_admin);

                // Show success message using SweetAlert2
                echo '<script>alert("Prestasi berhasil diinputkan");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=verifikasi_prestasi"; }, 10);</script>';
            } catch (Exception $e) {
                // Show error message using SweetAlert2
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=verifikasi_prestasi"; }, 3000);</script>';
            }
        }
    }

    //Prodi
    public function kelola_prodi()
    {
        try {
            $prodis = $this->prodi->getAll();
            $data = [
                "screen" => "kelola_prodi",
                "title" => "Kelola Prodi",
                "prodis" => $prodis
            ];
            $this->view('admin/index', $data);
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
        }
    }

    public function createProdi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nama = $_POST['nama'];
                $this->prodi->create($nama);
                echo '<script>alert("Prodi berhasil ditambahkan");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=kelola_prodi"; }, 10);</script>';
            } catch (Exception $e) {
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=kelola_prodi"; }, 10);</script>';
            }
        }
    }

    public function updateProdi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                $this->prodi->update($id, $nama);
                echo json_encode(['success' => true, 'message' => 'Prodi berhasil diupdate']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=kelola_prodi"; }, 3000);</script>';
            }
        }
    }

    public function deleteProdi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $this->prodi->delete($id);
                echo '<script>alert("Prodi berhasil dihapus");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=kelola_prodi"; }, 10);</script>';
            } catch (Exception $e) {
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=kelola_prodi"; }, 10);</script>';
            }
        }
    }


    //Tingkatan
    public function kelola_tingkatan()
    {
        try {
            $tingkatans = $this->tingkatan->getAll();
            $data = [
                "screen" => "kelola_tingkatan",
                "title" => "Kelola Tingkatan",
                "tingkatans" => $tingkatans
            ];
            $this->view('admin/kelola_tingkatan', $data);
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
        }
    }

    public function createTingkatan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nama = $_POST['nama'];
                $point = $_POST['point'];
                $this->tingkatan->create($nama, $point);
                echo json_encode(['success' => true, 'message' => 'Tingkatan berhasil ditambahkan']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function updateTingkatan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                $point = $_POST['point'];
                $this->tingkatan->update($id, $nama, $point);
                echo json_encode(['success' => true, 'message' => 'Tingkatan berhasil diupdate']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function deleteTingkatan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $this->tingkatan->delete($id);
                echo json_encode(['success' => true, 'message' => 'Tingkatan berhasil dihapus']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    // CRUD for Peringkat
    public function kelola_peringkat()
    {
        try {
            $peringkats = $this->peringkat->getAll();
            $data = [
                "screen" => "kelola_peringkat",
                "title" => "Kelola Peringkat",
                "peringkats" => $peringkats
            ];
            $this->view('admin/kelola_peringkat', $data);
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
        }
    }

    public function createPeringkat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nama = $_POST['nama'];
                $multiple = $_POST['multiple'];
                $this->peringkat->create($nama, $multiple);
                echo json_encode(['success' => true, 'message' => 'Peringkat berhasil ditambahkan']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function updatePeringkat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                $multiple = $_POST['multiple'];
                $this->peringkat->update($id, $nama, $multiple);
                echo json_encode(['success' => true, 'message' => 'Peringkat berhasil diupdate']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function deletePeringkat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $this->peringkat->delete($id);
                echo json_encode(['success' => true, 'message' => 'Peringkat berhasil dihapus']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    public function exportExcel()
    {
        try {
            $verifikasiPenghargaanOv = $this->admin->getAllVerifikasiAndPenghargaanOv();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set the header
            // Set the header
            $sheet->setCellValue('A1', 'Nama Mahasiswa');
            $sheet->setCellValue('B1', 'Tanggal Lomba');
            $sheet->setCellValue('C1', 'Judul Lomba');
            $sheet->setCellValue('D1', 'Tingkatan');
            $sheet->setCellValue('E1', 'Verifikasi Admin');
            $sheet->setCellValue('F1', 'Verifikasi Dosen');
            $sheet->setCellValue('G1', 'Nama Prodi');
            $sheet->setCellValue('H1', 'Nama Peringkat');

            // Populate the data
            $row = 2;
            foreach ($verifikasiPenghargaanOv as $verifikasi) {
                $sheet->setCellValue('A' . $row, $verifikasi['mahasiswa_name'] ?? '-');
                $sheet->setCellValue('B' . $row, $verifikasi['tanggal_mulai'] ?? '-');
                $sheet->setCellValue('C' . $row, $verifikasi['judul'] ?? '-');
                $sheet->setCellValue('D' . $row, $verifikasi['tingkatan_nama'] ?? '-');
                $sheet->setCellValue('E' . $row, $verifikasi['verif_admin'] ?? '-');
                $sheet->setCellValue('F' . $row, $verifikasi['verif_pembimbing'] ?? '-');
                $sheet->setCellValue('G' . $row, $verifikasi['prodi_nama'] ?? '-');
                $sheet->setCellValue('H' . $row, $verifikasi['peringkat_nama'] ?? '-');
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'verifikasi_prestasi.xlsx';

            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');

            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=riwayat"; }, 10);</script>';
        }
    }
}
