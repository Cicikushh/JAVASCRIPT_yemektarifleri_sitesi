<?php
session_start();
require_once 'db.php';

$kullanici_adi = $_POST['kullanici_adi'];
$sifre         = $_POST['sifre'];

$sql  = "SELECT * FROM kullanicilar WHERE kullanici_adi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kullanici_adi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  if (password_verify($sifre, $user['sifre'])) {
    // Giriş başarılı: hem kullanıcı adı hem ID’yi sakla
    $_SESSION['kullanici']    = $user['kullanici_adi'];
    $_SESSION['kullanici_id'] = $user['id'];
    header("Location: index.php");
    exit();
  } else {
    echo "Hatalı şifre!";
  }
} else {
  echo "Kullanıcı bulunamadı!";
}

$stmt->close();
$conn->close();
