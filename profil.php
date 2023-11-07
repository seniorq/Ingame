<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Połącz się z bazą danych - zmienne $host, $username, $password i $database muszą być ustawione
$host = "localhost";
$username = "root";
$password = "";
$database = "base";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Pobierz historię zakupów zalogowanego użytkownika
$user_id = $_SESSION['logged_in'];
$sql = "SELECT * FROM historia_zakupow WHERE user_id = $user_id";
$result = $conn->query($sql);

// Zamknij połączenie z bazą danych, jeśli nie jest już potrzebne
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - <?php echo $_SESSION['first_name']; ?></title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <header>
        <div class="logo">
            <h1>InGame</h1>
            <span>Witaj, <?php echo $_SESSION['logged_in']; ?></span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="profil.php">Profil</a></li>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <div class="content">
        <h2>Witaj, <?php echo $_SESSION['logged_in']; ?>!</h2>
        <p>Tu znajdziesz informacje o swoim profilu.</p>

        <h2>Historia zakupów:</h2>
       
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2023 InGame. All rights reserved.</p>
            <p>Contact: info@ingame.com</p>
        </div>
    </footer>
</body>
</html>
