<?php
require 'config/database.php';
$db = new database();
# Get the avatar name
if(isset($_SESSION['user-id'])){
    $avatar_name = $db->getAvatar($_SESSION['user-id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/icon__logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!--================================================= CDN ==========================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!--================================================= FONTSTYLE: poppins ==========================================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Vampiro+One&display=swap" rel="stylesheet">
    <!--================================================= STYLESHEET ==========================================================-->
    <link rel="stylesheet" href="<?=ROOT_URL?>CSS/style.css">
    <title>COMPLETE FUNCTIONNAL BLOG</title>
</head>
<body>
    <nav>
        <div class="container nav__container">
            <h2 class="nav__logo"><a href="<?=ROOT_URL?>index.php">GAMIFY</a></h2>
            <ul class="nav__container-links">
                <li><a href="<?=ROOT_URL?>blog.php">Blog</a></li>
                <li><a href="<?=ROOT_URL?>about.php">About</a></li>
                <li><a href="<?=ROOT_URL?>services.php">Services</a></li>
                <li><a href="<?=ROOT_URL?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])): ?> <!-- If I successfully login -->
                    <li class="nav__profile">
                        <div class="avatar"><img src="<?=ROOT_URL?>images/<?=$avatar_name?>" alt=""></div>
                        <ul>
                            <li><a href="<?=ROOT_URL?>admin/index.php">Dashboard</a></li>
                            <li><a href="<?=ROOT_URL?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                <li><a href="<?=ROOT_URL?>signin.php">Sign In</a></li>
                <?php endif?>
            </ul>
            <button id="open__nav-btn"><i class="fa-solid fa-bars"></i></button>
            <button id="close__nav-btn"><i class="fa-solid fa-x"></i></i></button>
        </div>
    </nav>
<!--================================================= END OF NAVBAR  ==========================================================-->