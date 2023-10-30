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

$sql = "SELECT * FROM verzamelaar";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes | UrbanKicks</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/shoe.css">
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

        <!-- shoes -->
        <div class="main-content">
            <div class="wrapper">
                <div class="img-shoes">
                    <?php
                    $error = "";

                        $shoeId = $_GET['id']; 

                        $sql = "SELECT * FROM verzamelaar WHERE id = $shoeId";
                        $result = $conn->query($sql);

                        if ($row  = $result->fetch_assoc()) {
                            $imgshoe1 = $row["img1"];
                            $imgshoe2 = $row["img2"];
                            $imgshoe3 = $row["img3"];
                        }
                    ?>

                    <div class="thumbnails">
                        <div class="thumbnail">
                            <img src="<?php echo $imgshoe1; ?>" class="thumbnail-img">
                        </div>
                        <div class="thumbnail">
                            <img src="<?php echo $imgshoe2; ?>" class="thumbnail-img">
                        </div>
                        <div class="thumbnail">
                            <img src="<?php echo $imgshoe3; ?>" class="thumbnail-img">
                        </div>
                        </div>

                    <div class="slide">
                        <div class="arrow-buttons">
                            <button id="prev-button" class="arrow-button">&#10094;</button>
                            <button id="next-button" class="arrow-button">&#10095;</button>
                        </div>
                        <img src="<?php echo $imgshoe1; ?>" class="img" id="main-slide">
                    </div>
                

        <!-- info -->
                    <div class="info">
                        <?php
                            echo "<h2>" . $row['name'] . "</h2>";
                            echo '<p>Geslacht: ' . $row["geslacht"] . '</p>';
                            echo '<br>';
                            echo '<br>';
                            echo '<p>Prijs: €' . $row["prijs"] . '</p>';
                            echo '<br>';
                            echo '<p>Maat: ' . $row["maat"] . '</p>';
                        ?>
                        <br>
                        <br>
                        <a href="./cart.php"><button class="winkelwagen">Winkelwagen</button></a>
                    </div> 
                </div>
    
            </div>
        </div>
        <br>
        <br>
        <div class="beschrijving">
                <h1>Beschrijving</h1>
                <br>
                <?php 
                    echo '<p>' . $row["beschrijving"] . '</p>';
                ?>
        </div>  


        <script src="../scripts/shoe.js"></script>
</body>
</html>