<?php
require_once 'app/models/Mahasiswa.php';
require_once 'app/core/Database.php';


$db = Database::getInstance(getDatabaseConfig(), [$this, 'error']);
$mahasiswaModel = new Mahasiswa($db);

$mahasiswa = $mahasiswaModel->getMahasiswaByUserId($_SESSION['user_id']);
$mahasiswa['prodi'] = $mahasiswaModel->getProdiNameByMahasiswaProdiId($mahasiswa['prodi_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa Page</title>
</head>
<body>
    <?php include_once VIEWS. "mahasiswa/_header.php";?>
    <?php include_once VIEWS. "layouts/_navbar.php";?>
<?php include_once VIEWS . "mahasiswa/__sidebar.php"; ?>
<p>Your username is <?= $_SESSION['username'] ?></p>
    <p>Your user ID is <?= $_SESSION['user_id']?>.</p>
    <h1>Welcome to the Mahasiswa Page</h1>
    <p>This is a protected area for Mahasiswa only.</p>
    <p>Hi, Mahasiswa! Your name is <?= $mahasiswa['name'] ?>.</p>
    <p>Your NIM is <?= $mahasiswa['nim'] ?>.</p>
  
    <p>Your Prodi is <?= $mahasiswa['prodi'] ?>.</p>
    <p>yout alamat is <?=$mahasiswa['Alamat']?></p>
   
</body>
</html>