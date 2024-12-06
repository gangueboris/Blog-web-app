<?php
include 'partials/header.php';

# Get users from the database
$db = new database();
$curr_id = $_SESSION['user-id'];
$users = $db->getManageUsers($curr_id);
?>
<section class="dashboard">
<!--===================================Notifications of changements ====================================-->
    <?php if(isset($_SESSION['add-user-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-user-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['edit-user-error'])): # Show error when editing user?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['edit-user-error'];
                    unset($_SESSION['edit-user-error']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-user-success'])):?>
        <div class="alert__message success container">
            <p>
                <?=$_SESSION['delete-user-success'];
                    unset($_SESSION['delete-user-success']);
                ?>    
            </p>
        </div>
    <?php elseif(isset($_SESSION['delete-user-error'])):?>
        <div class="alert__message error container">
            <p>
                <?=$_SESSION['delete-user-error'];
                    unset($_SESSION['delete-user-success']);
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
                <?php if(!isset($_SESSION['is-admin'])): # Show other parameters only form admins 
                       header("Location: " . ROOT_URL . 'admin/'); 
                ?> 
                <?php endif?>
                
                    <li>
                        <a href="<?=ROOT_URL?>admin/add-user.php">
                            <i class="fa-solid fa-address-card"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT_URL?>admin/manage-user.php" class="active">
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
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php if(count($users) > 0): ?> <!-- Display only when I have user to display-->
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user):?>
                        <tr>
                            <td><?=$user['FirstName'] . " " .$user['LastName'] ?></td>
                            <td><?= $user['UserName'] ?></td>
                            <td><a href="<?=ROOT_URL?>admin/edit-user.php?id=<?=$user['Id']?>" class="btn sm">Edit</a></td>
                            <td><a href="<?=ROOT_URL?>blog-class.php?id=user;<?=$user['Id']?>"  class="btn sm danger">Delete</a></td>
                            <td><?= $user['Admin'] ? 'Yes': 'No'?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else:?>
            <div class="alert__message error">No user found</div>
            <?php endif ?>

        </main>
    </div>
</section>


<?php
include '../partials/footer.php'
?>