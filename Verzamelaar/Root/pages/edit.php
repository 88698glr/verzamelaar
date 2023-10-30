<?php
@include 'config.php';

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $sql = "SELECT * FROM verzamelaar WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product niet gevonden.";
        exit();
    }
} else {
    echo "Product-ID ontbreekt in de URL.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $new_name = $_POST["name"];
        $new_maat = $_POST["maat"];
        $new_beschrijving = $_POST["beschrijving"];
        $new_geslacht = $_POST["geslacht"];
        $new_merk = $_POST["merk"];
        $new_prijs = $_POST["prijs"];
        
        $update_sql = "UPDATE verzamelaar SET name = '$new_name', maat = '$new_maat', beschrijving = '$new_beschrijving', geslacht = '$new_geslacht', merk = '$new_merk', prijs = $new_prijs WHERE id = $product_id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "Productinformatie is bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van productinformatie: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Product</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    <header>
        <h1>Bewerk Product</h1>
    </header>
    <div class="container">
        <section id="edit-product-form">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Naam schoen:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
                
                <label for="maat">Maat:</label>
                <input type="text" id="maat" name="maat" value="<?php echo $row['maat']; ?>" required>
    
                <label for="beschrijving">Beschrijving:</label>
                <textarea id="beschrijving" name="beschrijving" rows="4" required><?php echo $row['beschrijving']; ?></textarea><br>
            
                <label for="geslacht">Geslacht:</label>
                <input type="text" id="geslacht" name="geslacht" value="<?php echo $row['geslacht']; ?>" required>
    
                <label for="merk">Merk:</label>
                <input type="text" id="merk" name="merk" value="<?php echo $row['merk']; ?>" required>
    
                <label for="prijs">Prijs:</label>
                <input type="number" id="prijs" name="prijs" value="<?php echo $row['prijs']; ?>" step="0.01" required>
        
                <input type="submit" name="submit" value="Bijwerken">
            </form>
            <a href="admin.php">Terug naar admin page</a>
        </section>
    </div>
</body>
</html>
