<?php
include 'partials/header.php';
$db = new database();
$user_id = (int)$_SESSION['user-id'];

$posts = $db->getPosts($user_id);
?>

<section class="dashboard">
<?php if(isset($_SESSION['edit-post-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-post-error'])):?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['edit-post-error'];
                    unset($_SESSION['edit-post-error']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-post-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['delete-post-success'];
                    unset($_SESSION['delete-post-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-post-error'])):?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['delete-post-error'];
                    unset($_SESSION['delete-post-error']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['add-post-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['add-post-error'])):?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['add-post-error'];
                    unset($_SESSION['add-post-error']);
                ?>    
            </p>
        </div> 

    <?php endif ?>
    <div class="container dashboard__container">
        <button id="show_sidebar-btn" class="sidebar__toggle"><i class="fa-solid fa-angle-right"></i></button>
        <button id="hide_sidebar-btn" class="sidebar__toggle"><i class="fa-solid fa-angle-left"></i></button>
        <aside>
            <ul class="dashboard__items">
                <li>
                    <a href="<?=ROOT_URL?>admin/add-post.php">
                        <i class="fa-solid fa-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="<?=ROOT_URL?>admin/index.php" class="active">
                        <i class="fa-solid fa-address-card"></i>
                        <h5>Manage Post</h5>
                    </a> 
                </li>
                <?php if(isset($_SESSION['is-admin'])):?>
                    <li>
                        <a href="<?=ROOT_URL?>admin/add-user.php">
                            <i class="fa-solid fa-address-card"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT_URL?>admin/manage-user.php">
                            <i class="fa-regular fa-address-book"></i>
                            <h5>Manage user</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT_URL?>admin/add-category.php">
                            <i class="fa-regular fa-pen-to-square"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT_URL?>admin/manage-categories.php">
                            <i class="fa-solid fa-bars-staggered"></i>
                            <h5>Manage Category</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Post</h2>
            <?php if(count($posts) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td><?=$post['Title']?></td>
                        <td><?=$db->getCategoryTitle($post['Category_id'])?></td>
                        <td><a href="<?=ROOT_URL?>admin/edit-post.php?id=<?=$post['Id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?=ROOT_URL?>blog-class.php?id=post;<?=$post['Id']?>"  class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <?php else:?>
            <div class="alert__message error">No category found</div>
            <?php endif ?> 
        </main>
    </div>
</section>



<?php
include '../partials/footer.php'
?>