<?php
session_start();
require('db.php');

// jika sudah login sebelumnya maka dilempar ke dashboard masing-masing
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'admin') {
    header('Location: admin/admin_dashboard.php');
    exit();
  } elseif ($_SESSION['role'] == 'guru') {
    header('Location: guru/guru_dashboard.php');
    exit();
  }
}

// mengecek input login untuk masuk ke dalam dashboard
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['nama'] = $row['username'];

    if ($row['role'] == 'admin') {
      header('Location: admin/admin_dashboard.php');
    } elseif ($row['role'] == 'guru') {
      header('Location: guru/guru_dashboard.php');
    }
  } else {
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/login-form.css">
</head>

<body>
  <div class="page-login">
    <div class="page-login-kiri">
      <div class="logo-agenda">
        <img src="assets/img/login-form/logo-text2.png">
      </div>
    </div>
    <div class="page-login-kanan">
      <div class="title-login">
        <p>Welcome Back</p>
      </div>
      <div class="title-login-child">
        <p>Login Page</p>
      </div>
      <div class="form-login">
        <br>
        <?php if (isset($error)) : ?>
          <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; width: 50%;">
            Username atau password yang Anda masukkan salah. Mohon coba lagi.
          </div>
        <?php endif; ?>
        <form action="" method="post">
          <input class="name-pw" type="text" name="username" placeholder="Username" autocomplete="off" required>
          <br><br>
          <input class="name-pw" type="password" name="password" placeholder="Password" autocomplete="off" required>
          <br><br>
          <button type="submit" name="login">SignIn</button>
        </form>
      </div>
    </div>
  </div>
  <div class="link">
    <a class="inilink1" href="#">About</a>
    <a class="inilink2" href="#">Home</a>
    <a class="inilink3" href="#">FAQ</a>
  </div>
</body>

</html>