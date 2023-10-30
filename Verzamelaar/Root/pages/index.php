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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($conn->connect_error) {
    die("Fout bij de verbinding met de database: " . $conn->connect_error);
}

$sql = "SELECT * FROM verzamelaar LIMIT 9";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | UrbanKicks</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <!-- nav -->
        <nav>
            <div class="logo-con">
                <a href="index.php" id="logo">UrbanKicks</a>
            </div>
            <input type="checkbox" id="hamburger">
            <label class="hamburger" for="hamburger">
                <i class="fa-solid fa-bars"></i>
            </label>

            <ul class="navbar">
                <li>
                    <a href="index.php" class="btn active">Home</a>
                </li>
                <li>
                    <a href="./sneakers.php" class="btn">Sneakers</a>
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

        <!-- background vid -->
        <div class="video-container">
        <video autoplay muted loop class="video-background">
            <source src="../images/background vid 2.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

        <!-- main -->
        <div class="main-content">
        <h1 class="shoetitel">
            Nieuwste sneakers
        </h1>
            <div class="product-card">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="shoe.php?id=' . $row['id'] . '" class="card-link">';
                        echo '<div class="card">';
                        echo '<img src="' . $row["img1"] . '" alt="' . $row["name"] . '">';
                        echo '<h2>' . $row["name"] . '</h2>';
                        echo '<p>Maat: ' . $row["maat"] . '</p>';
                        echo '<p>Geslacht: ' . $row["geslacht"] . '</p>';
                        echo '<p>Merk: ' . $row["merk"] . '</p>';
                        echo '<p>Prijs: €' . $row["prijs"] . '</p>';
                        echo '</div>';
                        echo '</a>';
                    }
                } else {
                    echo "Geen producten gevonden.";
                }
                ?>
            </div>
    </div>
</body>
</html>