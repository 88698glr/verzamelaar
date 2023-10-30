<?php
@include 'config.php';

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM verzamelaar";
$result = $conn->query($sql);

if(isset($_SESSION['email'])) {
    if ($_SESSION['email'] == "admin@gmail.com") {
    } else {
        header("Location: index.php");
        exit();
    } 
} else {
        header("Location: login.php");
        exit();
    }
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product Management</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <header>
        <h1>Product Management Panel</h1>
    </header>
    <div class="container">
    <section class="product-list">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naam</th>
                        <th>Prijs</th>
                        <th>Maat</th>
                        <th>Geslacht</th>
                        <th>Merk</th>
                        <th>Image</th>
                        <th>Bewerk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>€' . $row['prijs'] . '</td>';
                            echo '<td>' . $row['maat'] . '</td>';
                            echo '<td>' . $row['geslacht'] . '</td>';
                            echo '<td>' . $row['merk'] . '</td>';
                            echo '<td><img src="' . $row["img1"] . '" alt="' . $row["name"] . '"></td>';
                            echo '<td><a href="edit.php?id=' . $row['id'] . '" class="edit-button">Edit</a>';
                            echo '</br>';
                            echo '</br>';
                            echo '<a href="delete.php?id=' . $row['id'] . '" class="delete-button">Delete</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No products found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <br>
        <section id="product-form">
                <h2>Schoenen toevoegen</h2>
            <form action="process_product.php" method="post" enctype="multipart/form-data">
            <label for="name">Naam schoen:</label>
            <input type="text" id="name" name="name" required><br>
            
            <label for="maat">Maat:</label>
            <input type="text" id="maat" name="maat" required>

            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" rows="4" required></textarea><br>
        
            <label for="geslacht">Geslacht:</label>
            <input type="text" id="geslacht" name="geslacht" required>

            <label for="merk">Merk:</label>
            <input type="text" id="merk" name="merk" required>

            <label for="prijs">Prijs:</label>
            <input type="number" id="prijs" name="prijs" step="0.01" required>

            <label for="img1">Afbeelding 1 URL:</label>
            <input type="url" id="img1" name="img1" required><br>
    
            <label for="img2">Afbeelding 2 URL:</label>
            <input type="url" id="img2" name="img2"><br>
    
            <label for="img3">Afbeelding 3 URL:</label>
            <input type="url" id="img3" name="img3"><br>
    
            <input type="submit" value="Voeg schoen toe">
            </form>
            <div class="links">
                <a href="logout.php" class="Logout">LOGOUT</a>
                <a href="index.php" class="Website">Terug naar Website</a>
            </div>
        </section>
    </div>
</body>
</html>