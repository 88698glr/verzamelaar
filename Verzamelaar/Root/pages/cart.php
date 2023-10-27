<?php
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | UrbanKicks</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/cart.css">
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
                    <a href="./index.php" class="btn ">Home</a>
                </li>
                <li>
                    <a href="./sneakers.php" class="btn">Sneakers</a>
                </li>
                <li>
                    <a href="./contact.php" class="btn">Contact</a>
                </li>
                <?php echo $dashboardLink; ?>
                <li>
                    <a href="cart.php" class="btn active"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
            </ul>
        </nav>

        <!-- cart -->
        <div class="error">
            <h1>404 ERROR</h1>
            <p>This page cannot be found</p>
        </div>
</body>
</html>