<?php
include 'partials/header.php';

# Get the category from the database
$category_id = (int)$_GET['id'];
$db = new database();
$category  = $db->getCategory($category_id);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <form action="<?= ROOT_URL?>blog-class.php" method="post">
            <input type="hidden" value="<?=$category_id?>" name="id">
            <input type="text" placeholder="Title" name="title" value="<?=$category['Title']?>">
            <textarea name="description"  rows="5" placeholder="Description"><?= htmlspecialchars($category['Description'] ?? '') ?></textarea>
            <button type="submit" class="btn" name="edit-category">Update Category</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>