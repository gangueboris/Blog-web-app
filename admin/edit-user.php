<?php
include 'partials/header.php';

#echo "<br><br><br><br><br>";
# Get the editing user from the database

$db = new database();
$user_id = $_GET['id'];
$user = $db->getUser((int)$user_id);


# Get user informations
$userName = $user['UserName'];
$status = $user['Admin'];

?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <form action="<?=ROOT_URL?>blog-class.php" method="post">
            <input type="hidden" value="<?=$user_id?>" name="id">
            <input type="text" name="userName" placeholder="Username" value="<?=$userName?>">
            <select name="status">
                <option value="" selected>Select Status</option>
                <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Admin</option>
                <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Author</option>
            </select>
            <button type="submit" class="btn" name="edit-user">Update User</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>
