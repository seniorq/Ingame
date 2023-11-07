<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="about.css">
  <title>InGame Page</title>
</head>
<body>
  <header>
    <div class="logo">
      <h1>InGame</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="profil.php">Profil</a></li>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
          <li><a href="logout.php">Logout</a></li>
        <?php } else { ?>
          <li><a href="login.php">Login</a></li>
        <?php } ?>
      </ul>
    </nav>
    <div class="right-section">
      <div class="cart">
        <a href=""><img src="cart.png"></a>
        <span>Koszyk</span>
      </div>
    </div>
  </header>

  <div class="content">
    <div class="column">
      <?php
      // Sprawdź, którą kolumnę wyświetlić na podstawie zmiennej $currentPage
      switch ($currentPage) {
        case 1:
          include 'about_us.php';
          break;
        case 2:
          include 'games.php';
          break;
        case 3:
          include 'contact.php';
          break;
        default:
          echo 'Nieprawidłowa strona.';
      }
      ?>
    </div>
  </div>

  <div style="text-align: center;">
    <a href="?page=1">O nas</a>
    <a href="?page=2">Gry</a>
    <a href="?page=3">Kontakt</a>
  </div>

  <footer>
    <div class="footer-content">
      <p>&copy; 2023 InGame. All rights reserved.</p>
      <p>Contact: info@ingame.com</p>
    </div>
  </footer>
</body>
</html>
