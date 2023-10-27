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
    <title>Contact | UrbanKicks</title>
    <link rel="icon" href="../images/logo.jpg">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/contact.css">
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
                    <a href="./sneakers.php" class="btn">Sneakers</a>
                </li>
                <li>
                    <a href="contact.php" class="btn active">Contact</a>
                </li>
                <?php echo $dashboardLink; ?>
                <li>
                    <a href="./cart.php" class="btn"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
            </ul>
        </nav>

        <!-- contact -->
        <?php
        if(!empty($_POST["send"])) {
            $userName = $_POST["userName"];
            $userEmail = $_POST["userEmail"];
            $userPhone = $_POST["userPhone"];
            $userCompany = $_POST["userCompany"];
            $userMessage = $_POST["userMessage"];
            $toEmail = "hutsfluts84@gmail.com";

            $mailHeaders = "Name: " . $userName .
            "\r\n Email: " . $userEmail .
            "\r\n Phone: " . $userPhone .
            "\r\n Company: " . $userCompany .
            "\r\n Message: " . $userMessage . "\r\n";

            if(mail($toEmail, $userName, $mailHeaders)){
                $message = "Jouw informatie is succesvol gestuurd!";
            }
        }
        ?>

        <!-- Contact -->
        <div class="form-container">
            <form method="post" name="emailContact">
                <div class="input-row">
                    <label>Naam <em>*</em></label>
                    <input type="text" name="userName" placeholder="Naam" required>
                </div>
                <div class="input-row">
                    <label>Email <em>*</em></label>
                    <input type="email" name="userEmail" placeholder="example@gmail.com" required>
                </div>
                <div class="input-row">
                    <label>Telefoonnummer <em>*</em></label>
                    <input type="text" name="userPhone" oninput="validatePhoneNumber(this)" pattern="[0-9]{10}" placeholder="0612345678" required>
                </div>
                <div class="input-row">
                    <label>Bedrijf <em>*</em></label>
                    <input type="text" name="userCompany" placeholder="Example bv" required>
                </div>
                <div class="input-row">
                    <label>Bericht <em>*</em></label>
                    <textarea name="userMessage" placeholder="Hi, vraag of zeg iets" required></textarea>
                </div>
                <div class="input-row">
                    <input type="submit" name="send" value="Verstuur">
                    <?php if(!empty($message)){ ?>
                    <div class="succes">
                        <strong><?php echo $message; ?></strong>
                    </div>
                    <?php } ?>
                </div>
            </form>
        </div>

        <script src="../scripts/contact.js"></script>
</body>
</html>