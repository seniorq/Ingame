<?php
$servername = "localhost";
$username = "root"; // Twoja nazwa użytkownika bazy danych
$password = ""; // Twoje hasło bazy danych
$dbname = "base";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Haszowanie hasła
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Rejestracja udana!";
        // Przekierowanie do strony logowania
        header("Location: login.php");
        exit;
    } else {
        echo "Błąd podczas rejestracji: " . $conn->error;
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>Rejestracja</title>
    <script>
        function validateForm() {
            var firstName = document.getElementById('firstName').value;
            var lastName = document.getElementById('lastName').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (firstName === "" || lastName === "" || email === "" || password === "") {
                alert("Wszystkie pola muszą być uzupełnione.");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Rejestracja</h2>
            <form method="post" onsubmit="return validateForm();">
                <div class="input-group">
                    <label for="firstName">Imię:</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Podaj imię">
                </div>
                <div class="input-group">
                    <label for="lastName">Nazwisko:</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Podaj nazwisko">
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Podaj email">
                </div>
                <div class="input-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" placeholder="Podaj hasło">
                </div>
                <button type="submit" class="przycisk" name="register">Zarejestruj</button>

                <button><a href="login.php">Mam konto</a></button>
            </form>
        </div>
    </div>
</body>
</html>
