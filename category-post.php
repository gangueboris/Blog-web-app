<?php
include 'partials/header.php';
$db = new database();
$categories = $db->getCategories();
$categories_posts = $_SESSION['category-post-data'];
$category = $_SESSION['category-post-category'];
unset($_SESSION['category-post-category']);
unset($_SESSION['category-post-data']);
?>

<!--================================================= CATEGORIES TITLE ==========================================================-->
<header class="category__title">
    <h1><?=$category?></h1>
</header>


<section class="general__post">
    <?php if(empty($categories_posts)): ?>
        <div class="alert__message error">
            <p>No posts found for this category</p>
        </div>
    <?php else: ?>
    <div class="container general__post-container">
        <?php foreach($categories_posts as $category_post):?>
            <article class="post">
                <div class="post-image">
                    <img src="./images/<?=$category_post['Thumbnail']?>" alt="firstimage.jpg">
                </div>
                <div class="post-content">
                    <?php 
                    # Get Category & Author
                        $category_id = (int)$category_post['Category_id'];
                        $author_id =  (int)$category_post['Author_id'];
                        $category = $db->getCategory($category_id)[0];
                        $author = $db->getUSer($author_id);
                    ?>
                    <h2 class="post__title"><a href="post.php"><?=$category_post['Title']?></a></h2>
                    <p class="post__text"><?=substr($category_post['Description'], 0, 300)?>...</p> <!--Troncatenation-->
                    <div class="post_profile">
                        <div class="post_profile-img">
                            <img src="./images/<?=$author['Avatar']?>" alt="prfile-img.jpg">
                        </div>
                        <div class="post-profile-info">
                            <h6>By: <?=$author['FirstName'] . "  " . $author['LastName']?></h6>
                            <p><?=date("M d, Y - H:i", strtotime($category_post['Date_time']))?></p>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach?>
    </div>
    <?php endif ?>
</section>
<section class="categories">
    <div class=" container categories__container">
        <?php foreach($categories as $category):?>
            <a href="<?=ROOT_URL?>blog-class.php?id=category-post;<?=$category['Id']?>" class="category"><?=$category['Title']?></a>
        <?php endforeach ?>
    </div>
</section>

<?php
include 'partials/footer.php';
?>