<?php
@include 'config.php';

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM verzamelaar";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "DELETE FROM verzamelaar WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
