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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kup_teraz'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    $conn = new mysqli("localhost", "root", "", "base");

    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }

    // Wstawianie produktu do tabeli z automatycznie generowanym towar_id
    $sql = "INSERT INTO produkty (nazwa, cena) VALUES (?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sd", $productName, $productPrice);

        if ($stmt->execute()) {
        } else {
            echo "Błąd: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Błąd: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>InGame</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="about.php">About</a></li>
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
            <a href="koszyk.php">KOSZYK</a>
            </div>
        </div>
    </header>

    <div class="content">
    <div class="products">
            <!-- Pozostała zawartość produktów -->
            <div class="product">
                <img src="dark.png">
                <h3>Dark Souls III</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="Dark Souls III">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>

            <div class ="product">
                <img src="csg.jpg">
                <h3>CS GO</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="CS GO">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
            <div class ="product">
                <img src="call.png">
                <h3>CALL OF DUTY</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="CALL OF DUTY">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
            <div class ="product">
                <img src="ark.jpg">
                <h3>AKR SURVIVAL</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="ARK">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
        </div>
        <br>
        <div class="products">
            <div class ="product">
                <img src="watch.jpg">
                <h3>Watch Dogs</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="watch dogs">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
            <div class ="product">
                <img src="battle.jpg">
                <h3>Battlefield 4</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="Battlefield">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
            <div class ="product">
                <img src="red.jpg">
                <h3>Red Dead</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="Red Dead">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
            <div class ="product">
                <img src="alyx.jpg">
                <h3>Half-Life:Alyx</h3>
                <p>Cena: $10.00</p>
                <form method="post">
                    <!-- Przycisk "Kup Teraz" z danymi produktu -->
                    <input type="hidden" name="product_name" value="Half-Life-alyx">
                    <input type="hidden" name="product_price" value="10.00">
                    <button type="submit" name="kup_teraz">Kup Teraz</button>
                </form>
            </div>
        </div>
        
    </div>
    <footer>
        <div class="footer-content">
            <p>&copy; 2023 InGame. All rights reserved.</p>
            <p>Contact: info@ingame.com</p>
        </div>
    </footer>
</body>
</html>
