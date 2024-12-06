<?php
  require 'config/constants.php';
  # Grap input
  $username_email = $_SESSION['signin-data']['username_email'] ?? null;
  $password = $_SESSION['signin-data']['password'] ?? null;

  unset($_SESSION['signin-data']);
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
    <title>main-page</title>
</head>
<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h1>Sign In</h1>
            <!-- Execute only the user just signin-->
            <?php if(isset($_SESSION['signup-success'])):?>
                <div class="alert__message success">
                    <p>
                        <?=$_SESSION['signup-success'];
                            unset($_SESSION['signup-success']);
                        ?>    
                    </p>
                </div>
            <?php elseif(isset($_SESSION['signin'])): ?>
                <div class="alert__message error">
                    <p>
                        <?=$_SESSION['signin'];
                            unset($_SESSION['signin']);
                        ?>    
                    </p>
                </div>
            <?php endif ?>
            <form action="<?=ROOT_URL?>blog-class.php" method="post">
                <input type="text" name="username_email" placeholder="Username or Email" value="<?=$username_email?>">
                <input type="password" name="password" placeholder="Password" value="<?=$password?>">
                <button type="submit" class="btn" name="signin">Sign Up</button>
            </form>
            <small>Already have an account? <a href="signup.php">Sign Up</a></small>
        </div>
       
    </section>

</body>
</html>