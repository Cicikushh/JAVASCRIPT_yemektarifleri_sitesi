<?php
// add_favorite.php
session_start();
header('Content-Type: application/json');

// Proje kök dizinindeki db.php dosyasını yükle
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['kullanici_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'msg' => 'not_logged']);
    exit;
}

$userId = $_SESSION['kullanici_id'];
$name   = trim($_POST['recipe_name'] ?? '');
$url    = trim($_POST['recipe_url']  ?? '');

// Geçersiz veri kontrolü
if ($name === '' || $url === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'msg' => 'invalid']);
    exit;
}

// Mevcut mu kontrol et
$stmt = $conn->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND recipe_url = ?");
$stmt->bind_param("is", $userId, $url);
$stmt->execute();
$exists = $stmt->get_result()->num_rows > 0;
$stmt->close();

if ($exists) {
    // Silme işlemi
    $del = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND recipe_url = ?");
    $del->bind_param("is", $userId, $url);
    $del->execute();
    $del->close();
    $action = 'removed';
} else {
    // Ekleme işlemi
    $ins = $conn->prepare(
        "INSERT INTO favorites (user_id, recipe_name, recipe_url)
         VALUES (?, ?, ?)"
    );
    $ins->bind_param("iss", $userId, $name, $url);
    $ins->execute();
    $ins->close();
    $action = 'added';
}

// Başarılı yanıt
echo json_encode(['success' => true, 'action' => $action]);
