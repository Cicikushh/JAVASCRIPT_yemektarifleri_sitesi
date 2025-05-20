<?php
// Veritabanı bilgileri
$host = "localhost";
$dbname = "kullanici_sistemi";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$isim = $_POST['name'] ?? '';
$soyad = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$telefon = $_POST['phone'] ?? '';
$mesaj = $_POST['message'] ?? '';

$mesajDurum = "";
if ($isim && $soyad && $email && $telefon && $mesaj) {
    $sql = "INSERT INTO iletisim (isim, soyad, email, telefon, mesaj) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $isim, $soyad, $email, $telefon, $mesaj);

    if ($stmt->execute()) {
        $mesajDurum = "Mesajınız başarıyla gönderildi!";
    } else {
        $mesajDurum = "Mesaj gönderilirken bir hata oluştu.";
    }

    $stmt->close();
} else {
    $mesajDurum = "Lütfen tüm alanları doldurun.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesaj Durumu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgba(0,0,0,0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .popup {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        .popup h2 {
            margin-bottom: 20px;
        }

        .popup button {
            background-color: #fb5849;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #e14b3e;
        }
    </style>
</head>
<body>
    <div class="popup">
        <h2><?php echo $mesajDurum; ?></h2>
        <button onclick="window.location.href='index.php#reservation'">Tamam</button>
    </div>
</body>
</html>
