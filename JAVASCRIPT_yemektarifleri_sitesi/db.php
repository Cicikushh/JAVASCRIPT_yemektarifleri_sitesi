<?php
// db.php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "kullanici_sistemi";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatasını kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Karakter seti (opsiyonel ama önerilir)
$conn->set_charset("utf8mb4");
