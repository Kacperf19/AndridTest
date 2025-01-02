<?php
session_start(); // Rozpoczęcie sesji
$host = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Połączenie z bazą danych
$conn = new mysqli($host, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();


    if (password_verify($password, $user['password'])) {

      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['user_image'] = $user['image'];


      header('Location: index.php');
      exit();
    } else {
      echo "<script>alert('Nieprawidłowe hasło');</script>";
    }
  } else {
    echo "<script>alert('Nieznaleziono użytkownika');</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
