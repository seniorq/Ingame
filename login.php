<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];


        if ($email === "admin@gmail.com" && $password === "haslo") {

            $_SESSION['admin'] = true;
            header("Location: admin.php");
            exit();
        }


        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {

                $_SESSION['logged_in'] = true;


                header("Location: index.php");
                exit();
            } else {
                $loginError = "Błędne hasło. Spróbuj ponownie.";
            }
        } else {
            $loginError = "Użytkownik o podanym emailu nie istnieje.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>Logowanie</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Logowanie</h2>
            <form method="post">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Podaj email">
                </div>
                <div class="input-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" placeholder="Podaj hasło">
                </div>
                <button type="submit" class="przycisk" name="login">Zaloguj</button>
                <button><a href="register.php">Nie mam konta</a></button>
            </form>
            <?php if (isset($loginError)) { echo "<p>$loginError</p>"; } ?>
        </div>
    </div>
</body>
</html>
