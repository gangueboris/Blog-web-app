<?php
include 'partials/header.php';

echo "<br> <br> <br>";
$db = new database();
$categories = $db->getCategories();
if(isset($_GET['id'])){
    $post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = $db->getPostColumn('Title', $post_id);
    $description =$db->getPostColumn('Description', $post_id);
    $featured = $db->getPostColumn('Is_featured', $post_id);
    $thumbnail =  $db->getPostColumn('Thumbnail', $post_id);    
}else{
    header('Location: ' . ROOT_URL . 'admin/');
}

?>
<section class="form__section">
    <div class="container form__section-container">
        <?php if(isset($_SESSION['edit-post'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-post'];
                            unset($_SESSION['edit-post']);
                        ?>
                    </p>
                </div>
        <?php endif ?>
        <h2>Edit post</h2>
        <form action="<?=ROOT_URL?>blog-class.php" enctype="multipart/form-data" method="post">
            <input type="hidden" value="<?=$post_id?>" name="id">
            <input type="hidden" name="previous_thumbnail_name" value="<?=$thumbnail?>">
            <input type="text" name="title" placeholder="Title" value="<?=$title?>">
            <select name="category">
                <?php foreach($categories as $category): ?>
                    <option value="<?=$category['Id']?>"><?=$category['Title']?></option>
                <?php endforeach ?>
            </select>
            <textarea name="description" rows="10" placeholder="Content"><?=htmlspecialchars($description)?></textarea>
            <div class=" uploadfile__container inline">
                <?php if(isset($_SESSION['is-admin'])): ?>
                    <input type="checkbox" name="featured" id="is_featured" value="1" checked>
                    <label for="is_featured">Featured</label>
                <?php endif ?>
            </div>
            <div class="uploadfile__container">
                <label for="avatar">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="avatar">
            </div>
            <button type="submit" class="btn" name="edit-post">Update Post</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php'
?>