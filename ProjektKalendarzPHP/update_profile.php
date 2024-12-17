<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Połączenie nie powiodło się: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$new_username = trim($_POST['username']);
$profile_image = $_FILES['profile_image'];

$image_name = $_SESSION['user_image'];

if ($profile_image['error'] == 0) {

  $image_extension = pathinfo($profile_image['name'], PATHINFO_EXTENSION);
  $new_image_name = uniqid() . '.' . $image_extension;
  $image_path = 'uploads/' . $new_image_name;


  if (move_uploaded_file($profile_image['tmp_name'], $image_path)) {

    if (file_exists('uploads/' . $image_name)) {
      unlink('uploads/' . $image_name);
    }
    $image_name = $new_image_name;
  } else {
    echo "Błąd podczas przesyłania pliku.";
    exit();
  }
}


$sql = "UPDATE users SET username = ?, user_image = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
  die('Błąd przygotowania zapytania SQL: ' . $conn->error);
}


$stmt->bind_param("ssi", $new_username, $image_name, $user_id);


if ($stmt->execute()) {
  $_SESSION['username'] = $new_username;
  $_SESSION['user_image'] = $image_name;

  header('Location: profile.php');
} else {
  echo "Wystąpił błąd podczas aktualizacji profilu: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
