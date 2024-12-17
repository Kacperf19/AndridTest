
<?php
session_start();

if (!isset($_SESSION['username'])) {
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
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$current_username = $user['username'];
$current_image = $user['user_image'];
$imagePath = 'uploads/' . $current_image;

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/styleAdd.css">
  <meta name="description" content="">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <meta property="og:image:alt" content="">

  <link rel="icon" href="img/icona.ico" sizes="any">
  <link rel="icon" href="img/icon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="img/icon.png">

  <link rel="manifest" href="site.webmanifest">
  <meta name="theme-color" content="#fafafa">
    <title>Edycja profilu</title>
</head>
<body>

<div class="container">
  <div class="user-panel">
    <h2>Panel użytkownika</h2><div class="user-panel">
      <img id="user-image" src="<?php echo htmlspecialchars($imagePath); ?>" alt="User Image">
      <h2 id="user-name"><?php echo htmlspecialchars($current_username); ?></h2>
    </div>
    <ul >
      <li><a href="profile.php">Profil</a></li>
      <li><a href="index.php">Kalendarz</a></li>
      <li><a href="setting.php">Ustawienia</a></li>

      <li><a href="logout.php">Wyloguj</a></li>

    </ul>
  </div>
  <div class="calendar">
    <h1>Edytuj profil</h1>
    <div class="settingsT">

    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
      <img src="uploads/<?php echo htmlspecialchars($current_image); ?>" alt="Aktualne zdjęcie" width="100"><br><br>

      <label for="profile_image">Zmień zdjęcie profilowe:</label>
      <br>
      <input type="file" id="profile_image" name="profile_image"><br><br>



        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($current_username); ?>" required><br><br>





        <input type="submit" value="Zapisz zmiany">
    </form>
    </div>
  </div>
  <div class="container1">

  </div>
</body>
</html>
