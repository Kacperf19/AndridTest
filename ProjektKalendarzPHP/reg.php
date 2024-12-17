<?php


@include'register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rejestracja</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
  <h1>Zarejestruj się</h1>
  <br>


  <form  method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Register</button>
  </form>
</div>
</body>
</html>
