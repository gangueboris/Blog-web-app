<?php
include 'partials/header.php';
$db = new database();
$categories = $db->getCategories();

# Get post informations
$title = $_SESSION['add-post-data']['title'] ?? "";
$description = $_SESSION['add-post-data']['description'] ?? "";
$category = $_SESSION['add-post-data']['category'] ?? "";

unset($_SESSION['add-post-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add post</h2>
        <?php if(isset($_SESSION['add-post'])): ?>
            <div class="alert__message error">
                <p>
                    <?=$_SESSION['add-post'];
                      unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?=ROOT_URL?>blog-class.php" enctype="multipart/form-data" method="post">
            <input type="text" placeholder="Title" name="title" value="<?=$title?>">
            <select name="category">
                <?php foreach($categories as $category): ?>
                    <option value="<?=$category['Id']?>"><?=$category['Title']?></option>
               <?php endforeach ?>
            </select>
            <textarea rows="10" placeholder="Content" name="description"><?=htmlspecialchars($description)?></textarea>
            <div class=" uploadfile__container inline">
                <!-- Allow admin only to press the featured ... -->
                <?php if(isset($_SESSION['is-admin'])):?>
                    <input type="checkbox" id="is_featured" value="1" name="featured" checked>
                    <label for="is_featured">Featured</label>
                <?php endif ?>
            </div>
            <div class="uploadfile__container">
                <label for="avatar">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="avatar">
            </div>
            <button type="submit" class="btn" name="add-post">Add Post</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>