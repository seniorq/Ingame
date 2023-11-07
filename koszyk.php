<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Połączenie z bazą danych
$conn = new mysqli("localhost", "root", "", "base");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Obsługa usuwania produktu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $productId = $_POST['product_id'];

    // Usuń produkt z bazy danych
    $sql = "DELETE FROM produkty WHERE towar_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            
        } else {
            echo "Błąd podczas usuwania produktu: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Błąd: " . $conn->error;
    }
}

// Pobranie wszystkich produktów z bazy danych
$sql = "SELECT * FROM produkty";
$result = $conn->query($sql);

$produkty = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $produkty[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE, edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep z grami</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>InGame</h1>
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
        <div class="right-section">
            <div class="cart">
                <a href="koszyk.php"><img src="" alt="Koszyk"></a>
            </div>
        </div>
    </header>

    <div class="content">
        <h1>Produkty</h1>
        <div class="products">
            <?php foreach ($produkty as $produkt) { ?>
                <div class="product">
                    <h3><?php echo $produkt['nazwa']; ?></h3>
                    <p>Cena: $<?php echo $produkt['cena']; ?></p>
                    <form method="post">
                        <!-- Przycisk "Usuń produkt" z danymi produktu -->
                        <input type="hidden" name="product_id" value="<?php echo $produkt['towar_id']; ?>">
                        <button type="submit" name="delete_product">Usuń produkt</button>
                    </form>
                </div>
            <?php } ?>
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
