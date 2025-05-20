<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['kullanici_id'])) {
  http_response_code(403);
  exit('Oturum yok');
}

$userId = $_SESSION['kullanici_id'];
$stmt   = $conn->prepare(
  "SELECT recipe_name, recipe_url
   FROM favorites
   WHERE user_id=?
   ORDER BY created_at DESC"
);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "<p>Henüz favori eklemediniz.</p>";
} else {
  echo '<ul class="fav-list">';
  while ($row = $result->fetch_assoc()) {
    $name = htmlspecialchars($row['recipe_name']);
    $url  = htmlspecialchars($row['recipe_url']);
    echo "<li>
            $name
            <a class='goto-btn' href='$url' target='_blank'>Tarife Git</a>
          </li>";
  }
  echo '</ul>';
}
