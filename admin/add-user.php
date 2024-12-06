<?php
include 'partials/header.php';

# Grab previous input
$firstName = $_SESSION['add-user-data']['first_name'] ?? "";
$lastName = $_SESSION['add-user-data']['last_name']?? "";
$username = $_SESSION['add-user-data']['username'] ?? "";
$password = $_SESSION['add-user-data']['password'] ?? "";
$confirm_password = $_SESSION['add-user-data']['confirm_password'] ?? "";
$email = $_SESSION['add-user-data']['email'] ?? "";
$userRole = $_SESSION['add-user-data']['user-role'] ?? "";

echo "<br> <br> <br> <br> <br>";
echo $userRole;
unset($_SESSION['add-user-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add-user'])): ?>
            <div class="alert__message error">
                <p>
                    <?=$_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?=ROOT_URL?>blog-class.php" enctype="multipart/form-data" method="post">
            <input type="text" placeholder="First Name" name="first_name" value="<?=$firstName?>">
            <input type="text" placeholder="Last Name" name="last_name" value="<?=$lastName?>">
            <input type="text" placeholder="Username" name="username" value="<?=$username?>">
            <input type="email" placeholder="Email" name="email" value="<?=$email?>">
            <input type="password" placeholder="Create Password" name="password" value="<?=$password?>">
            <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?=$confirm_password?>">
            <select name="user-role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="uploadfile__container">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" class="btn" name="add-user">Add User</button>
        </form>
    </div>
    
</section>

<?php
include '../partials/footer.php'
?>