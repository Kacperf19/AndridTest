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
      <h2 id="user-name"><?php echo htmlspecialchars($current_username); ?></h2>
    </div>
    <ul >
      <li><a href="profile.php">Profil</a></li>
      <li><a href="index.php">Kalendarz</a></li>
      <li><a href="setting.php">Ustawienia</a></li>

      <li><a href="logout.php" onclick="reload()">Wyloguj</a></li>

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
     <h1>Zadania na 7 dni</h1>
    <div class="task-container">
      
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$today = date('Y-m-d');

$sql = "
    SELECT tasks.*
    FROM tasks
    INNER JOIN user_tasks ON user_tasks.task_id = tasks.id
    WHERE user_tasks.user_id = ?
    AND tasks.task_date >= ?
    AND tasks.task_date <= DATE_ADD(?, INTERVAL 7 DAY)
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $today, $today);
$stmt->execute();
$result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
      echo "<div>";
      echo "<form method='POST' action='update_task.php'>";
echo "<input type='hidden' name='task_id' value='{$row['id']}'>";
echo "<h2>{$row['task_date']}</h2>";
echo "Task Description: {$row['task_description']}<br>";
echo "Time: {$row['start_time']} - {$row['end_time']}<br>";
echo "<button type='submit' class='us'>Usuń</button>";
echo "</form><br>";

     
       echo "</div>";
    }



$conn->close();

?>
    
    </div>


     <button class="but" onclick="sendTasksToDatabase()">Zapisz zadania</button>

  </div>
</div>



<script src="js/app.js"></script>
<script src="js/script.js"></script>
<script>
  function sendTasksToDatabase() {
    fetch("save.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(tasks)
    })
      .then(response => response.json())
      .then(data => {
        if (data.status === "success") {
          alert("Zadania zostały zapisane do bazy danych.");
           location.reload(); 
        } else {
          alert("Wystąpił błąd: " + data.message);
        }
      })
      .catch(error => {
        console.error("Błąd:", error);
        alert("Nie udało się zapisać zadań.");
      });
  }
  function reload() {
    localStorage.clear();
   location.reload();
}

</script>


</body>

</html>

