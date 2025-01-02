<?php
session_start();
@include 'dane.php';
?>

<!DOCTYPE html>

  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>



  <div class="login">
    <h1>Zaloguj się</h1>
    <br>

    <form method="POST">
      <div>
        <label for="username">Nazwa użytkownika:</label>
        <br>
        <br>
        <input type="text" id="username" name="username" required>
      </div>
      <div>

        <br>
        <label for="password">Hasło:</label>
        <br>
        <br>
        <input type="password" id="password" name="password" required>
      </div>
      <br>
      <button type="submit">Zaloguj się</button>
      <a href="reg.php">Zarejestruj</a>

    </form>
  </div>

  </body>
  </html>
<?php
