<?php
session_start();


if (!isset($_SESSION['user_id'])) {
  header('Location: login.php'); // Przekierowanie na stronę logowania
  exit();
}

$userId =  $_SESSION['user_id'];
$username = $_SESSION['username'];
$userImage = isset($_SESSION['user_image']) ? $_SESSION['user_image'] : 'user.png';
$imagePath = 'uploads/' . $userImage;
// Domyślny obraz, jeśli brak w bazie
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="css/style.css">
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
    <h2>Panel użytkownika</h2><div class="user-panel">
      <img id="user-image" src="<?php echo htmlspecialchars($imagePath); ?>" alt="User Image">
      <h2 id="user-name"><?php echo htmlspecialchars($username); ?></h2>
    </div>
    <ul >
      <li><a href="profile.php">Profil</a></li>
      <li><a href="index.php">Kalendarz</a></li>
      <li><a href="setting.php">Ustawienia</a></li>

      <li><a href="logout.php">Wyloguj</a></li>

    </ul>
  </div>

  <div class="calendar">
    <h1>Kalendarz</h1>
    <div id="calendar"></div>

    <div class="tasks">
      <div class="task-input">
        <input type="text" id="taskInput" placeholder="Dodaj zadanie">
        <input type="time" id="startTime" placeholder="Godzina początkowa (HH:mm)">
        <input type="time" id="endTime" placeholder="Godzina końcowa (HH:mm)">
        <button onclick="addTask()">Dodaj zadanie</button>
      </div>

    </div>
  </div>
  <div class="container1">
    <div id="taskList" class="task-list">Wybierz dzień, aby zobaczyć lub dodać zadania.</div>
  </div>
</div>



<script src="js/app.js"></script>
<script src="js/script.js"></script>
<script>




</script>


</body>

</html>

