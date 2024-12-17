<?php
$host = "localhost";

$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($host, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);


  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('Użytkownik istnieje');</script>";
  } else {

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
      echo "<script>alert('sukces Witaj nowy użytkowniku');</script>";
      header('Location: login.php');
      exit();
    } else {
      echo "<script>alert('Bład podczas rejestracji');</script>". $stmt->error . "</p>";
    }
  }

  $stmt->close();
  $conn->close();
}
?>
