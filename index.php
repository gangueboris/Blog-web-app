<?php
 echo "<br> <br> <br>";
    include 'partials/header.php';
    $db = new database();
    $categories = $db->getCategories();
    $posts = $db->getPostsDisplay();
    $featured = $db->getFeatured();
?>

    <section class="last__post">
        <?php if($featured):
            $category_id = $featured['Category_id'];
            $author_id = $featured['Author_id'];
            $category = $db->getCategory($category_id)[0];
            $author = $db->getuser($author_id);
        ?>
            <div class="container last__post-container">
                <div class="post-image">
                    <img src="./images/<?=$featured['Thumbnail']?>" alt="firstimage.jpg">
                </div>
                <div class="post-content">
                    <a href="<?=ROOT_URL?>blog-class.php?id=category-post;<?=$category['Id']?>" class="category"><?=$category['Title']?></a>
                    <h2 class="post__title"><a href="post.php"><?=$featured['Title']?></a></h2>
                    <p class="post__text"><?=substr($featured['Description'], 0, 300)?>...</p>
                    <div class="post_profile">
                        <div class="post_profile-img">
                            <img src="images/<?=$author['Avatar']?>" alt="profile-img.jpg">
                        </div>
                        <div class="post-profile-info">
                            <h6 class="post__profile-author">By: <?=$author['FirstName'] . ' ' . $author['LastName']?></h6>
                            <p class="post__profile-date"><?=date("M d, Y - H:i", strtotime($featured['Date_time']))?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>  
    </section>

    <section class="general__post">
        <div class="container general__post-container">
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
