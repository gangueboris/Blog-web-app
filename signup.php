<?php 
require 'config/constants.php'; 

# Grab previous input
$firstName = $_SESSION['signup-data']['first_name'] ?? "";
$lastName = $_SESSION['signup-data']['last_name']?? "";
$username = $_SESSION['signup-data']['username'] ?? "";
$password = $_SESSION['signup-data']['password'] ?? "";
$confirm_password = $_SESSION['signup-data']['confirm_password'] ?? "";
$email = $_SESSION['signup-data']['email'] ?? "";

unset($_SESSION['signup-data']);
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
    <link rel="stylesheet" href="CSS/style.css">
    <title>main-page</title>
</head>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h1>Sign Up</h1>
                <?php if(isset($_SESSION['signup'])) : ?>
                       <div class='alert__message error'>
                           <p> 
                               <?=$_SESSION['signup'];
                                unset($_SESSION['signup']);
                               ?>
                           </p>
                       </div>
                <?php endif ?>
            
            <form action="<?=ROOT_URL?>blog-class.php" enctype="multipart/form-data" method="post">
                <input type="text" name="first_name" placeholder="First Name" value="<?=$firstName?>">
                <input type="text" name= "last_name" placeholder="Last Name"  value="<?=$lastName?>">
                <input type="text" name="username" placeholder="Username"  value="<?=$username?>">
                <input type="email" name="email" placeholder="Email"  value="<?=$email?>">
                <input type="password" name= "password" placeholder="Create Password"  value="<?=$password?>">
                <input type="password"  name="confirm_password" placeholder="Confirm Password"  value="<?=$confirm_password?>">
                <div class="uploadfile__container">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" class="btn" name="signup">Sign Up</button>
            </form>
            <small>Already have an account? <a href="signin.php">Sign In</a></small>
        </div>
       
    </section>

</body>
</htmlf>