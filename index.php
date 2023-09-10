<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form method="post" action="">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login" value="Login">Login</button>
  </form>

  <?php
  session_start();
  require('db.php');

  // jika sudah login diarahkan ke dashboard masing-masing
  if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
      header('Location: admin/admin_dashboard.php');
      exit();
    } elseif ($_SESSION['role'] == 'guru') {
      header('Location: guru/guru_dashboard.php');
      exit();
    }
  }

  // cek login untuk masuk ke dalam dashboard
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, role, nama FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['id'] = $row['id'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['nama'] = $row['nama'];

      if ($row['role'] == 'admin') {
        header('Location: admin/admin_dashboard.php');
      } elseif ($row['role'] == 'guru') {
        header('Location: guru/guru_dashboard.php');
      }
    } else {
      echo "Login gagal. Periksa kembali username dan password Anda.";
    }
  }
  ?>


</body>

</html>