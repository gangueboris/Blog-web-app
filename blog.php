<?php
 echo "<br> <br> <br>";
    include 'partials/header.php';
    $db = new database();
    $categories = $db->getCategories();
    $posts = $db->getPostsDisplay();
    $featured = $db->getFeatured();

?>
<!--================================================= SEARCH-BAR ==========================================================-->
<section class="search">
    <?php if(isset($_SESSION['search'])): ?>
                <div class="alert__message container error search__container">
                    <p>
                        <?= $_SESSION['search'];
                            unset($_SESSION['search']);
                        ?>
                    </p>
                </div>
    <?php endif ?>
    <form class="container search__container" action="<?=ROOT_URL?>blog-class.php" method="POST">
        <div>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="Search" name="search">
        </div>
        <button class="search__btn" type="submit" name="search__btn">Go</button>
    </form>
</section>

<section class="general__post">
        <div class="container general__post-container">
            <?php if(isset($_SESSION['search-result'])): 
               $posts = $_SESSION['search-result'];
               unset($_SESSION['search-result']);
            ?>

            <?php elseif(isset($_SESSION['search-result-error'])): $posts = array();?>
                
                <div class="alert__message error container">
                   <p>
                       <?= $_SESSION['search-result-error'];
                           unset($_SESSION['search-result-error']);
                       ?>
                   </p>
               </div>
            <?php endif ?>
            <?php foreach($posts as $post):?>
            <article class="post">
                <div class="post-image">
                    <img src="./images/<?=$post['Thumbnail']?>" alt="firstimage.jpg">
                </div>
                <div class="post-content">
                    <?php 
                    # Get Category & Author
                        $category_id = (int)$post['Category_id'];
                        $author_id =  (int)$post['Author_id'];
                        $category = $db->getCategory($category_id)[0];
                        $author = $db->getUSer($author_id);
                    ?>
                    <a href="<?=ROOT_URL?>blog-class.php?id=category-post;<?=$category['Id']?>" class="category"><?=$category['Title']?></a>
                    <h2 class="post__title"><a href="post.php"><?=$post['Title']?></a></h2>
                    <p class="post__text"><?=substr($post['Description'], 0, 300)?>...</p> <!--Troncatenation-->
                    <div class="post_profile">
                        <div class="post_profile-img">
                            <img src="./images/<?=$author['Avatar']?>" alt="prfile-img.jpg">
                        </div>
                        <div class="post-profile-info">
                            <h6>By: <?=$author['FirstName'] . "  " . $author['LastName']?></h6>
                            <p><?=date("M d, Y - H:i", strtotime($post['Date_time']))?></p>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach?>
        </div>
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