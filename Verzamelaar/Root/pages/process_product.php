<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beroeps-lj2";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Databaseverbinding is mislukt: " . $conn->connect_error);
}
 
$titel = $_POST['name'];
$beschrijving = $_POST['beschrijving'];
$maat = $_POST['maat'];
$geslacht = $_POST['geslacht'];
$prijs = $_POST['prijs'];
$merk = $_POST['merk'];
$img1 = $_POST['img1'];
$img2 = $_POST['img2'];
$img3 = $_POST['img3'];

$sql = "INSERT INTO verzamelaar (name, img1, img2, img3, prijs, beschrijving, maat, geslacht, merk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssdssss", $titel, $img1, $img2, $img3, $prijs, $beschrijving, $maat, $geslacht, $merk);

if ($stmt->execute()) {
    header("location: admin.php");
} else {
    echo "Fout bij het toevoegen van het item aan de database: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>