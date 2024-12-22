<?php
include 'partials/header.php';
echo "<br> <br> <br>";
$post_id = $_GET['id'];
$post = $db->getPostColumn("*", $post_id)[0];
?>

<section class="singlepost">
<div class=" container singlepost__container">
    <h2><?=$post['Title']?></h2>
    <div class="post_profile">
        <?php 
            # Get Category & Author
            $category_id = (int)$post['Category_id'];
            $author_id =  (int)$post['Author_id'];
            $category = $db->getCategory($category_id)[0];
            $author = $db->getUSer($author_id);
        ?>
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
    <div class="singlepost__image">
        <img src="images/<?=$post['Thumbnail']?>" alt="">
    </div>
    <p><?=$post['Description']?></p>         
</div>
</section>

<?php
include 'partials/footer.php';
?>