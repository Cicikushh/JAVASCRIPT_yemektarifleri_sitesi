<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kullanici_sistemi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}

$ad = $_POST['ad'];
$soyad = $_POST['soyad'];
$kullanici_adi = $_POST['kullanici_adi'];
$sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);

$sql = "INSERT INTO kullanicilar (ad, soyad, kullanici_adi, sifre) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $ad, $soyad, $kullanici_adi, $sifre);

if ($stmt->execute()) {
  header("Location: login.html"); // kayıt başarılı, giriş sayfasına yönlendir
  exit();
} else {
  echo "Kayıt sırasında hata oluştu: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
