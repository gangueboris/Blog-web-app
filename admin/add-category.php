<?php
include 'partials/header.php';
# Get previous inputs
$title = $_SESSION['add-category-data']['title'] ?? "";
$description = $_SESSION['add-category-data']['description'] ?? "";

unset($_SESSION['add-category-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if(isset($_SESSION['add-category'])): ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                        unset($_SESSION['add-category']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?=ROOT_URL?>blog-class.php" method="post">
            <input type="text" name="title" placeholder="Title" value="<?= $title?>">
            <textarea name="description" rows="5" placeholder="Description"><?= htmlspecialchars($description) ?></textarea>
            <button type="submit" class="btn" name="add-category">Add Category</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>