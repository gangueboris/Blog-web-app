<?php
include 'partials/header.php';

# Get categories
$db = new database();
$categories = $db->getCategories();
?>

<section class="dashboard">
    <!--===================================Notifications of changements ====================================-->
    <?php if(isset($_SESSION['add-category-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['add-category-error'])):?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['add-category-error'];
                    unset($_SESSION['add-category-error']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-category-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['edit-category-success'];
                    unset($_SESSION['edit-category-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-category-error'])): # Show error when editing category?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['edit-category-error'];
                    unset($_SESSION['edit-category-error']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-category-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['delete-category-success'];
                    unset($_SESSION['delete-category-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-category-error'])):?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['delete-category-error'];
                    unset($_SESSION['delete-category-success']);
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
                    <a href="<?=ROOT_URL?>admin/index.php">
                        <i class="fa-solid fa-address-card"></i>
                        <h5>Manage Post</h5>
                    </a>
                    
                </li>
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
                    <a href="<?=ROOT_URL?>admin/manage-categories.php" class="active">
                        <i class="fa-solid fa-bars-staggered"></i>
                        <h5>Manage Category</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if(count($categories) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category):?>
                        <tr>
                            <td><?= $category['Title']?></td>
                            <td><a href="<?=ROOT_URL?>admin/edit-category.php?id=<?=$category['Id']?>" class="btn sm">Edit</a></td>
                            <td><a href="<?=ROOT_URL?>blog-class.php?id=category;<?=$category['Id']?>"  class="btn sm danger">Delete</a></td>
                        </tr>
                    <?php endforeach ?>
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









