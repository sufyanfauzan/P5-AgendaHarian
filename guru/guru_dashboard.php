<?php
session_start();
if (!isset($_SESSION['role'])) {
  header('Location: ../');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>guru</h1>
  <a href="logout.php">Logout</a>
</body>

</html>