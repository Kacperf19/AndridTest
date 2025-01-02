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
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
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
</head>

<body>
<div class="container">
  <div class="user-panel">
    <h2>Panel użytkownika</h2>
    <div class="user-panel">
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
    <h1>Ustawienia Strony</h1>

    <div class="setting">
      <label for="bg-color">Kolor tła strony</label>
      <input type="color" id="bg-color" value="#ffffff">
    </div>

    <div class="setting">
      <label for="text-color">Kolor tekstu</label>
      <input type="color" id="text-color" value="#000000">
    </div>

    <div class="setting">
      <label for="font-size">Rozmiar czcionki</label>
      <input type="range" id="font-size" min="10" max="30" value="16">
    </div>

    <div class="setting">
      <label for="font-family">Styl czcionki</label>
      <select id="font-family">
        <option value="Arial, sans-serif">Arial</option>
        <option value="'Times New Roman', serif">Times New Roman</option>
        <option value="'Courier New', monospace">Courier New</option>
        <option value="'Georgia', serif">Georgia</option>
      </select>
    </div>

    <button id="reset-btn">Resetuj ustawienia</button>



  </div>
  <div class="container1">

  </div>
</div>



<script src="js/app.js"></script>
<script src="js/script.js"></script>



</body>

</html>
