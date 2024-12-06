<?php
include 'partials/header.php';
$db = new database();
$categories = $db->getCategories();
?>

<!--================================================= SEARCH-BAR ==========================================================-->
<section class="search">
    <form class="container search__container" action="">
        <div>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="Search">
        </div>
        <button class="search__btn" type="submit">Go</button>
    </form>
</section>

<section class="general__post">
    <div class="container general__post-container">
        <article class="post">
            <div class="post-image">
                <img src="./images/blog8.jpg" alt="firstimage.jpg">
            </div>
            <div class="post-content">
                <a href="#" class="category">Business</a>
                <h2 class="post__title"><a href="post.php">How to choose bicycle for springs in Autralia, Shopping Centers ?</a></h2>
                <p class="post__text">Lorem ipsum dolor Lorem ipsum dolor sit amet. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint accusantium quam quis molestiae perferendis. Nemo nostrum culpa voluptatibus quod! Aut eligendi magni voluptatem omnis ea dolorum cumque, expedita quo maxime praesentium adipisci sunt fugit molestiae aliquam eaque provident. Eveniet, perspiciatis molestiae ipsa repellat, veniam, provident dolore cum cumque et ab iure quia impedit. Excepturi, harum id. sit amet, consectetur adipisicing elit. Quisquam nesciunt possimus commodi accusamus tempore inventore cupiditate, est architecto mollitia soluta quam, eaque, nam harum? Saepe, voluptas! Aut, quaerat. </p>
                <div class="post_profile">
                    <div class="post_profile-img">
                        <img src="./images/avatar15.jpg" alt="prfile-img.jpg">
                    </div>
                    <div class="post-profile-info">
                        <h6>By: Boris GANGUE</h6>
                        <p>November 30, 2024</p>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post-image">
                <img src="./images/blog8.jpg" alt="firstimage.jpg">
            </div>
            <div class="post-content">
                <a href="#" class="category">Business</a>
                <h2 class="post__title"><a href="post.php">How to choose bicycle for springs in Autralia, Shopping Centers ?</a></h2>
                <p class="post__text">Lorem ipsum dolor Lorem ipsum dolor sit amet. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint accusantium quam quis molestiae perferendis. Nemo nostrum culpa voluptatibus quod! Aut eligendi magni voluptatem omnis ea dolorum cumque, expedita quo maxime praesentium adipisci sunt fugit molestiae aliquam eaque provident. Eveniet, perspiciatis molestiae ipsa repellat, veniam, provident dolore cum cumque et ab iure quia impedit. Excepturi, harum id. sit amet, consectetur adipisicing elit. Quisquam nesciunt possimus commodi accusamus tempore inventore cupiditate, est architecto mollitia soluta quam, eaque, nam harum? Saepe, voluptas! Aut, quaerat. </p>
                <div class="post_profile">
                    <div class="post_profile-img">
                        <img src="./images/avatar4.jpg" alt="prfile-img.jpg">
                    </div>
                    <div class="post-profile-info">
                        <h6 class="post__profile-author">By: Boris GANGUE</h6>
                        <p class="post__profile-date">November 30, 2024</p>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post-image">
                <img src="./images/blog90.jpg" alt="firstimage.jpg">
            </div>
            <div class="post-content">
                <a href="#" class="category">Business</a>
                <h2 class="post__title"><a href="post.php">How to choose bicycle for springs in Autralia, Shopping Centers ?</a></h2>
                <p class="post__text">Lorem ipsum dolor Lorem ipsum dolor sit amet. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint accusantium quam quis molestiae perferendis. Nemo nostrum culpa voluptatibus quod! Aut eligendi magni voluptatem omnis ea dolorum cumque, expedita quo maxime praesentium adipisci sunt fugit molestiae aliquam eaque provident. Eveniet, perspiciatis molestiae ipsa repellat, veniam, provident dolore cum cumque et ab iure quia impedit. Excepturi, harum id. sit amet, consectetur adipisicing elit. Quisquam nesciunt possimus commodi accusamus tempore inventore cupiditate, est architecto mollitia soluta quam, eaque, nam harum? Saepe, voluptas! Aut, quaerat. </p>
                <div class="post_profile">
                    <div class="post_profile-img">
                        <img src="./images/avatar16.jpg" alt="prfile-img.jpg">
                    </div>
                    <div class="post-profile-info">
                        <h6 class="post__profile-author">By: Boris GANGUE</h6>
                        <p class="post__profile-date">November 30, 2024</p>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post-image">
                <img src="./images/blog5.jpg" alt="firstimage.jpg">
            </div>
            <div class="post-content">
                <a href="#" class="category">Business</a>
                <h2 class="post__title"><a href="post.php">How to choose bicycle for springs in Autralia, Shopping Centers ?</a></h2>
                <p class="post__text">Lorem ipsum dolor Lorem ipsum dolor sit amet. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint accusantium quam quis molestiae perferendis. Nemo nostrum culpa voluptatibus quod! Aut eligendi magni voluptatem omnis ea dolorum cumque, expedita quo maxime praesentium adipisci sunt fugit molestiae aliquam eaque provident. Eveniet, perspiciatis molestiae ipsa repellat, veniam, provident dolore cum cumque et ab iure quia impedit. Excepturi, harum id. sit amet, consectetur adipisicing elit. Quisquam nesciunt possimus commodi accusamus tempore inventore cupiditate, est architecto mollitia soluta quam, eaque, nam harum? Saepe, voluptas! Aut, quaerat. </p>
                <div class="post_profile">
                    <div class="post_profile-img">
                        <img src="./images/avatar12.jpg" alt="prfile-img.jpg">
                    </div>
                    <div class="post-profile-info">
                        <h6 class="post__profile-author">By: Boris GANGUE</h6>
                        <p class="post__profile-date">November 30, 2024</p>
                    </div>
                </div>
            </div>
        </article>   
    </div>
</section>
<section class="categories">
    <div class=" container categories__container">
    <?php foreach($categories as $category):?>
        <a href="<?=ROOT_URL?>category-post.php?id=<?=$category['Id']?>" class="category"><?=$category['Title']?></a>
    <?php endforeach ?>
    </div>
</section>

<?php
include 'partials/footer.php';
?>