<?php
@include 'config.php';

session_start();

if (isset($_SESSION['email'])) {
    if ($_SESSION['email'] == "admin@gmail.com") {
        $dashboardLink = '<li><a href="admin.php">Admin</a></li>';
    } else {
        $dashboardLink = '<li><a href="user.php">User</a></li>';
    }
} else {
    $dashboardLink = '<li><a href="login.php">Login</a></li>';
}

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

if ($conn->connect_error) {
    die("Fout bij de verbinding met de database: " . $conn->connect_error);
}

$geslachtFilter = "";
$prijsFilter = "";
$merkFilter = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["filter_submit"])) {
        $geslachtFilter = $_POST["geslacht"];
        $prijsFilter = $_POST["prijs"];
        $merkFilter = $_POST["merk"];
    }
}

$prijsMin = 0;
$prijsMax = PHP_INT_MAX;

if ($prijsFilter == "0-50") {
    $prijsMin = 0;
    $prijsMax = 50;
}
elseif ($prijsFilter == "50-100") {
    $prijsMin = 50;
    $prijsMax = 100;
} elseif ($prijsFilter == "100-150") {
    $prijsMin = 100;
    $prijsMax = 150;
} elseif ($prijsFilter == "150-plus") {
    $prijsMin = 150;
    $prijsMax = PHP_INT_MAX;
}

$sql = "SELECT * FROM verzamelaar WHERE 1";

if (!empty($geslachtFilter)) {
    $sql .= " AND geslacht = '$geslachtFilter'";
}

    $sql .= " AND prijs >= $prijsMin AND prijs <= $prijsMax";


if (!empty($merkFilter)) {
    $sql .= " AND merk = '$merkFilter'";
}

$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakers | UrbanKicks</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/sneakers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
        <!-- nav -->
        <nav>
            <div class="logo-con">
                <a href="./index.php" id="logo">UrbanKicks</a>
            </div>
            <input type="checkbox" id="hamburger">
            <label class="hamburger" for="hamburger">
                <i class="fa-solid fa-bars"></i>
            </label>

            <ul class="navbar">
                <li>
                    <a href="./index.php" class="btn">Home</a>
                </li>
                <li>
                    <a href="sneakers.php" class="btn active">Sneakers</a>
                </li>
                <li>
                    <a href="./contact.php" class="btn">Contact</a>
                </li>
                <?php echo $dashboardLink; ?>
                <li>
                    <a href="./cart.php" class="btn"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
            </ul>
        </nav>

        <!-- sidebar -->
        <div class="sidebar-mobile">
            <input type="checkbox" id="filter-checkbox">
            <label class="filter-button" for="filter-checkbox"><i class="fa-solid fa-sliders"></i> Filters</label>

            <form method="POST" action="sneakers.php" class="filter-form">
                <h2>Zoekopties</h2>
                <label for="geslacht">Geslacht:</label>
                <select name="geslacht" id="geslacht">
                    <option value="">Alle geslachten</option>
                    <option value="Heren">Heren</option>
                    <option value="Dames">Dames</option>
                    <option value="Kids">Kids</option>
                </select>
                <label for="prijs">Prijs:</label>
                <select name="prijs" id="prijs">
                    <option value="">Prijzen</option>
                    <option value="0-50">€0 - 50</option>
                    <option value="50-100">€50 - €100</option>
                    <option value="100-150">€100 - €150</option>
                    <option value="150-plus">€150+</option>
                </select>
                <label for="merk">Merk:</label>
                <select name="merk" id="merk">
                    <option value="">Alle Merken</option>
                    <option value="Nike">Nike</option>
                    <option value="Adidas">Adidas</option>
                    <option value="Jordans">Jordans</option>
                    <option value="New Balance">New Balance</option>
                </select>
                <input type="submit" name="filter_submit" value="Filteren">
                <input type="submit" name="reset_filters" value="Filters resetten">
            </form>
        </div>

        <!-- sidebar -->
        <main>
        <div class="container">
            <div class="sidebar">
                <form method="POST" action="sneakers.php">
                    <h2>Zoekopties</h2>
                    <label for="geslacht">Geslacht:</label>
                    <select name="geslacht" id="geslacht">
                        <option value="">Alle geslachten</option>
                        <option value="Heren">Heren</option>
                        <option value="Dames">Dames</option>
                        <option value="Kids">Kids</option>
                    </select>
                    <label for="prijs">Prijs:</label>
                    <select name="prijs" id="prijs">
                        <option value="">Prijzen</option>
                        <option value="0-50">€0 - 50</option>
                        <option value="50-100">€50 - €100</option>
                        <option value="100-150">€100 - €150</option>
                        <option value="150-plus">€150+</option>
                    </select>
                    <label for="merk">Merk:</label>
                    <select name="merk" id="merk">
                        <option value="">Alle Merken</option>
                        <option value="Nike">Nike</option>
                        <option value="Adidas">Adidas</option>
                        <option value="Jordans">Jordans</option>
                        <option value="New Balance">New Balance</option>
                    </select>
                    <input type="submit" name="filter_submit" value="Filteren">
                </form>
                <form method="POST" action="sneakers.php">
                    <input type="submit" name="reset_filters" value="Filters resetten">
                </form>
            </div>
        </div>

        <!-- shoenen -->
        <div class="main-content">
            <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card'>
                            <a href='shoe.php?id=" . $row['id'] . "' class='shoe'>
                            <div class='img-con'>
                                <img src='" . $row['img1'] . "' alt=''>
                            </div>
                            <div class='info'>
                                <h3>" . $row['name'] . "</h3>
                                <p>Maat: " . $row['maat'] . "</p>
                                <p>Prijs: €" . $row['prijs'] . "</p>
                            </div>
                        </a>
                            </div>";
                        }
                    } else {
                        echo "Geen resultaten gevonden.";
                    }
                ?>
        </div>
        </main>      
</body>
</html>