<?php

require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';
require_once 'app/models/Login.php';
require_once 'app/models/Admin.php';
require_once 'app/models/Prodi.php';
require_once 'app/models/Tingkatan.php';
require_once 'app/models/Peringkat.php';
require_once 'app/models/Dosen.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    private $admin;
    private $prodi;
    private $tingkatan;
    private $peringkat;
    private $mahasiswa;
    private $dosen;



    public function __construct()
    {
        $this->admin = new Admin(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->prodi = new Prodi(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->tingkatan = new Tingkatan(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->peringkat = new Peringkat(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->mahasiswa = new Mahasiswa(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
        $this->dosen = new Dosen(Database::getInstance(getDatabaseConfig(), [$this, 'error']));
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
            $adminCRUD = $this->admin->getAll();
            $mahasiswaCRUD = $this->mahasiswa->getAll();
            $dosenCRUD = $this->dosen->getAll();
            $users = $this->admin->getAllUsers();

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
                    "photo" => $dataAdmin['photo'],
                    "phone_number" => $dataAdmin['phone_number'],
                    "gender" => $dataAdmin['gender'],
                ],
                "verifikasiPenghargaan" => $this->admin->getAllVerifikasiAndPenghargaan(), //presma/SAN-SIGMA/admin/screen?screen=verifikasi_prestasi
                "verifikasiPenghargaanOv" => $this->admin->getAllVerifikasiAndPenghargaanOv(),//presma/SAN-SIGMA/admin/screen?screen=riwayat
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

                "passwordLama" => [
                    "password" => $this->admin->getPasswordByUserId($_SESSION['user_id'])
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
                "peringkats" => $peringkats,
                "admins" => $adminCRUD,
                "mahasiswas" => $mahasiswaCRUD,
                "dosens" => $dosenCRUD,
                "users" => $users




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


            // Set column headers
            $headers = [
                'A' => 'Nama Mahasiswa',
                'B' => 'Tanggal Lomba',
                'C' => 'Judul Lomba',
                'D' => 'Tingkatan',
                'E' => 'Verifikasi Admin',
                'F' => 'Verifikasi Dosen',
                'G' => 'Nama Prodi',
                'H' => 'Nama Peringkat'
            ];

            // Style the header row
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ]
            ];

            // Apply headers and styling
            foreach ($headers as $col => $text) {
                $sheet->setCellValue($col . '1', $text);
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
            $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

            // Add data rows with styling
            $row = 2;
            $dataStyle = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ]
            ];

            foreach ($verifikasiPenghargaanOv as $verifikasi) {
                $data = [
                    $verifikasi['mahasiswa_name'] ?? '-',
                    $verifikasi['tanggal_mulai'] ?? '-',
                    $verifikasi['judul'] ?? '-',
                    $verifikasi['tingkatan_nama'] ?? '-',
                    $verifikasi['verif_admin'] ?? '-',
                    $verifikasi['verif_pembimbing'] ?? '-',
                    $verifikasi['prodi_nama'] ?? '-',
                    $verifikasi['peringkat_nama'] ?? '-'
                ];

                $sheet->fromArray([$data], null, 'A' . $row);
                $row++;
            }

            // Apply styling to data range
            $lastRow = $row - 1;
            $sheet->getStyle('A1:H' . $lastRow)->applyFromArray($dataStyle);

            // Set zoom level
            $sheet->getSheetView()->setZoomScale(85);

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

    public function kelola_admin()
    {
        try {
            $admins = $this->admin->getAll();
            $data = [
                "screen" => "kelola_admin",
                "title" => "Kelola Admin",
                "admins" => $admins
            ];
            $this->view('admin/kelola_admin', $data);
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
        }
    }

    public function createAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $gender = $_POST['gender'];
                $phone_number = $_POST['phone_number'];
                $photo = $_POST['photo'];

                // Create user first
                $userId = $this->admin->createUser($name, $username, $password, 'admin');

                // Create admin with the user_id
                $this->admin->createAdmin($userId, $name, $gender, $phone_number, $photo);

                echo json_encode(['success' => true, 'message' => 'Admin berhasil ditambahkan']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function updateAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $admin_id = $_POST['admin_id'];
                $userId = $_POST['user_id'];
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $gender = $_POST['gender'];
                $phone_number = $_POST['phone_number'];
                $photo = $_POST['photo'];

                // Update user first
                $this->admin->updateUser($userId, $username, $password);

                // Update admin
                $this->admin->updateAdmin($admin_id, $name, $gender, $phone_number, $photo);

                echo json_encode(['success' => true, 'message' => 'Admin berhasil diupdate']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function deleteAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['admin_id'];
                $userId = $_POST['user_id'];

                // Delete admin
                $this->admin->deleteAdmin($id);

                // Delete user
                $this->admin->deleteUser($userId);

                echo json_encode(['success' => true, 'message' => 'Admin berhasil dihapus']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    public function kelola_mahasiswa()
    {
        try {
            $mahasiswas = $this->mahasiswa->getAll();
            $data = [
                "screen" => "kelola_mahasiswa",
                "title" => "Kelola Mahasiswa",
                "mahasiswas" => $mahasiswas
            ];
            $this->view('admin/kelola_mahasiswa', $data);
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
        }
    }

    public function createMahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $nim = $_POST['nim'];
                $gender = $_POST['gender'];
                $phone_number = $_POST['phone_number'];
                $photo = $_POST['photo'];
                $alamat = $_POST['alamat'];
                $kota = $_POST['kota'];
                $provinsi = $_POST['provinsi'];
                $agama = $_POST['agama'];
                $prodi_id = $_POST['prodi_id'];
                $college_year = $_POST['college_year'];
                $status = $_POST['status'];

                // Create user first
                $userId = $this->mahasiswa->createUser($name, $nim, $nim, 'mahasiswa');

                // Create mahasiswa with the user_id
                $this->mahasiswa->createMahasiswa($userId, $name, $nim, $gender, $phone_number, $photo, $alamat, $kota, $provinsi, $agama, $prodi_id, $college_year, $status);

                echo json_encode(['success' => true, 'message' => 'Mahasiswa berhasil ditambahkan']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function updateMahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nim = $_POST['nim'];
                $userId = $_POST['user_id'];
                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $phone_number = $_POST['phone_number'];
                $photo = $_POST['photo'];
                $alamat = $_POST['alamat'];
                $kota = $_POST['kota'];
                $provinsi = $_POST['provinsi'];
                $agama = $_POST['agama'];
                $prodi_id = $_POST['prodi_id'];
                $college_year = $_POST['college_year'];
                $status = $_POST['status'];

                // Update user first
                $this->mahasiswa->updateUser($userId, $nim, $nim);

                // Update mahasiswa
                $this->mahasiswa->updateMahasiswa($nim, $name, $gender, $phone_number, $photo, $alamat, $kota, $provinsi, $agama, $prodi_id, $college_year, $status);

                echo json_encode(['success' => true, 'message' => 'Mahasiswa berhasil diupdate']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function deleteMahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nim = $_POST['mahasiswa_id']; // Use nim as the identifier
                $userId = $_POST['user_id'];

                // Delete mahasiswa
                $this->mahasiswa->deleteMahasiswa($nim);

                // Delete user
                $this->mahasiswa->deleteUser($userId);

                echo json_encode(['success' => true, 'message' => 'Mahasiswa berhasil dihapus']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }


    public function kelola_dosen()
    {
        try {
            $dosens = $this->dosen->getAll();
            $data = [
                "screen" => "kelola_dosen",
                "title" => "Kelola Dosen",
                "dosens" => $dosens
            ];
            $this->view('admin/kelola_dosen', $data);
        } catch (Exception $e) {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "screen?screen=dashboard"; }, 10);</script>';
        }
    }

    public function createDosen()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $nip = $_POST['nip'];
                $gender = $_POST['gender'];
                $phone_number = $_POST['phone_number'];
                $photo = $_POST['photo'];
                $alamat = $_POST['alamat'];
                $kota = $_POST['kota'];
                $provinsi = $_POST['provinsi'];
                $agama = $_POST['agama'];
                $prodi_id = $_POST['prodi_id'];
                $status = $_POST['status'];

                // Create user first
                $userId = $this->dosen->createUser($name, $nip, $nip, 'dosen');

                // Create dosen with the user_id
                $this->dosen->createDosen($userId, $name, $nip, $gender, $phone_number, $photo, $alamat, $kota, $provinsi, $agama, $prodi_id, $status);

                echo json_encode(['success' => true, 'message' => 'Dosen berhasil ditambahkan']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function updateDosen()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nip = $_POST['nip'];
                $userId = $_POST['user_id'];
                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $phone_number = $_POST['phone_number'];
                $photo = $_POST['photo'];
                $alamat = $_POST['alamat'];
                $kota = $_POST['kota'];
                $provinsi = $_POST['provinsi'];
                $agama = $_POST['agama'];
                $prodi_id = $_POST['prodi_id'];
                $status = $_POST['status'];

                // Update user first
                $this->dosen->updateUser($userId, $nip, $nip);

                // Update dosen
                $this->dosen->updateDosen($nip, $name, $gender, $phone_number, $photo, $alamat, $kota, $provinsi, $agama, $prodi_id, $status);

                echo json_encode(['success' => true, 'message' => 'Dosen berhasil diupdate']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function deleteDosen()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nip = $_POST['nip'];
                $userId = $_POST['user_id'];

                // Delete dosen
                $this->dosen->deleteDosen($nip);

                // Delete user
                $this->dosen->deleteUser($userId);

                echo json_encode(['success' => true, 'message' => 'Dosen berhasil dihapus']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $oldPassword = $_POST['password-lama'];
                $newPassword = $_POST['password-baru'];
                $verifPassword = $_POST['password-baru-verif'];

                // Get stored password
                $storedPassword = $this->dosen->getPasswordByUserId($_SESSION['user_id']);

                // Validate old password
                if ($oldPassword !== $storedPassword) {
                    throw new Exception("Password lama tidak sesuai");
                }

                $this->dosen->changePasswordByUserId(
                    $_SESSION['user_id'],
                    $verifPassword,
                    $newPassword,
                    $oldPassword
                );

                // Redirect with success message
                header('Location: screen?screen=profile&message=Password berhasil diubah');
                exit();
            } catch (Exception $e) {
                // Redirect with error message
                header('Location: screen?screen=profile&error=' . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    public function uploadPhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
            try {
                $file = $_FILES['photo'];
                $id = $_POST['id'];

                // Validate image
                $check = getimagesize($file['tmp_name']);
                if ($check === false) {
                    throw new Exception("File is not an image");
                }

                // Validate file size (max 5MB)
                if ($file['size'] > 5242880) {
                    throw new Exception("File is too large. Maximum size is 5MB");
                }

                // cek tipe file
                $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($file['type'], $allowed)) {
                    throw new Exception("Invalid file type. Only JPG, JPEG & PNG files are allowed");
                }

                $uploadDir = dirname(__DIR__, 2) . '/assets/img/person/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }


                // Generate unique filename
                $filename = ($file['name']);
                $uploadFile = $uploadDir . $filename;

                // Delete old photo if exists
                $oldPhoto = $this->admin->getPhotoById($id);
                if ($oldPhoto && file_exists($uploadDir . $oldPhoto)) {
                    unlink($uploadDir . $oldPhoto);
                }


                // Move uploaded file
                if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    throw new Exception("Failed to upload file");
                }
                consoleLog('uploadFile', $uploadFile);
                consoleLog('moveFile', move_uploaded_file($file['tmp_name'], $uploadFile));
                // Update database
                $this->admin->updatePhoto($id, $filename);

                // Redirect back to profile
                header('Location: screen?screen=profile');
                exit();
            } catch (Exception $e) {
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "screen?screen=profile"; }, 10);</script>';
                exit();
            }
        }
    }
}
