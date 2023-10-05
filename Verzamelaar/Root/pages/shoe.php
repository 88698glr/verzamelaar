<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beroeps-lj2";

$conn = new mysqli($servername, $username, $password, $dbname);

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
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Zoeken...">
                    <button id="search-button"><i class="fa-solid fa-search"></i></button>
                </div>
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
                    <a href="#" class="btn">/#/</a>
                </li>
                <li>
                    <a href="#" class="btn">/#/</a>
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
                </div>       
            </div>
        </div>


        <script src="../scripts/shoe.js"></script>
</body>
</html>