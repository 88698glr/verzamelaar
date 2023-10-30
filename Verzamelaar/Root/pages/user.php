<?php
@include 'config.php';

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$gebruikersnaam = $_SESSION['name'];
$email = $_SESSION["email"]; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page | UrbanKicks</title>
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
    <div class="profile-container">
        <h2>Welkom op je profielpagina</h2>
        <p>Hier zijn je accountgegevens:</p>
        <ul>
            <li><strong>Gebruikersnaam:</strong> <?php echo $gebruikersnaam; ?></li>
            <li><strong>Email:</strong> <?php echo $email; ?></li>
        </ul>
        <a href="logout.php">Uitloggen</a>
        <a href="index.php">Terug naar Website</a>
    </div>
</body>
</html>