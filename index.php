<?php
session_start();

include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = htmlentities(strip_tags($_POST['user']));
    $pass = htmlentities(strip_tags($_POST['pass']));

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM admin WHERE user_admin = '$user' AND pass_admin = '$pass'";
    $exec = mysqli_query($conn, $query);

    if (mysqli_num_rows($exec) !== 0) {
        $res = mysqli_fetch_assoc($exec);
        $_SESSION['admin'] = $res['id_admin'];
        $_SESSION['nama_admin'] = $res['nama_admin'];
        $_SESSION['level'] = $res['level'];

        // Redirect berdasarkan level
        if ($res['level'] === 'admin') {
            header('location: dashboard_admin.php'); // Ganti dengan halaman admin
        } elseif ($res['level'] === 'user') {
            header('location: user/beranda.php'); // Ganti dengan halaman user
        }
        exit();
      } else {
          // Login gagal, simpan pesan error di session
          header("Location: error-500.php"); // Kembali ke halaman login
          exit();
      }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin/Siswa | SPP</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Sign in Admin</h2>
          <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="input" name="user" placeholder="Enter Username" required>
          </div>
          <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" id="password" class="input" name="pass" placeholder="Enter Password" required>
          </div>
          <input type="submit" name="login" value="Login" class="btn solid" />
          <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
            </div>
        </form>

          <form action="#" class="sign-up-form">
            <h2 class="title">Sign in Siswa</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="number" class="form-control" name="nisn" placeholder="Entered NISN" required>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="number" class="form-control" name="nis" placeholder="Entered NIS" required>
            </div>
            <input type="submit" name="login" class="btn" value="Login" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Entered as an Siswa</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Login
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Entered as an Admin</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Login
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
