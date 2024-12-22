<?php
require 'config/database.php';


class blog{
    # Private
    // Attributes
    private $db;
    
    // Constructor
    function __construct($pdo){
        $this->db = $pdo;
        
    }

    # Public
    public function handleRequest(){
        # POST resquest handling
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            # ======================== SIGNUP REQUEST =========================

            if(isset($_POST['signup'])){
                // Grabbing input elements
                $firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $username =  filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email =  filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                $password =  filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword =  filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $avatar = $_FILES['avatar']; // Is an array
                    
                /*When the input is invalid, I will create a sgnUp SESSION and store the message inside of that. */
                // Inputs validations
                if(!$firstName){
                    $_SESSION['signup'] = "Please enter a valid first name";
                }
                elseif(!$lastName){
                    $_SESSION['signup'] = "Please enter a valid last name";
                }
                elseif(!$username){
                    $_SESSION['signup'] = "Please enter a valid surname";
                }
                elseif(!$email){
                    $_SESSION['signup'] = "Please enter a valid email";
                }
                elseif(strlen($password) < 8 || strlen($confirmPassword) < 8){
                    $_SESSION['signup'] = "Password should be 8+ characters";
                }
                elseif(!$avatar['name']){
                    $_SESSION['signup'] = "Please add an avatar";
                }
                else{
                    // Check passwords matching
                    if($password !== $confirmPassword){
                        $_SESSION['signup'] = "Password don't match";
                    }
                    else{
                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        # Check if username or email(unique id) already exit in the database
                        if(count($this->db->isUserOrEmailInDb($username, $email)->fetchAll()) > 0){
                            $_SESSION['signup'] = "Username or email already exist";
                        }else{
                            // ============ Process the avatar ==============
                            // Rename the avatar
                            $time = time();
                            $avatar_name = $time . $avatar['name'];
                            $avatar_tmp_path = $avatar['tmp_name']; // Contains the path location of the image
                            $avatar_destination_path = 'images/' . $avatar_name;

                            // Check if the file is an image
                            $allowed_files = ['png', 'jpg', 'jpeg'];
                            $extention = explode('.', $avatar_name);
                            $extention = end($extention);
                            if(in_array($extention, $allowed_files)){
                                // Size must be less than 1mb
                                if($avatar['size'] < 1000000){
                                // Upload avatar
                                move_uploaded_file($avatar_tmp_path, $avatar_destination_path);
                                }else{
                                    $_SESSION['signup'] = "File too large. Should be less than 1mb";
                                }
                            }else{
                                $_SESSION['signup'] = "File should be png, jpg or jpeg";
                            }
                        }
                    }
                }
                # If there is any invalid input, put all input in a session and to avoid user retape and when the page refresh 
                # Store the inputs in the database
                if(isset($_SESSION['signup'])){
                $_SESSION['signup-data'] = $_POST; // Take the all information in the form
                header('Location: ' . ROOT_URL . 'signup.php');
                die();
                }else{
                    // Insertion of a new user into users table
                    $insert_user_result = $this->db->insertUser($firstName, $lastName, $username, $email, $hashed_password, $avatar_name);     
                    if($insert_user_result){
                        $_SESSION['signup-success'] = 'Registration successful. Please log in';
                        header('Location: ' . ROOT_URL . 'signin.php');
                        die();
                    }

                }  
            }
        
            # ======================== SIGNIN REQUEST =========================

            elseif(isset($_POST['signin'])){
                // Get signin input
                $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Valide the input
                if(!$username_email){
                    $_SESSION['signin'] = "Username or Email required";
                }
                elseif(!$password){
                    $_SESSION['signin'] = "Password is required";
                }else{
                    $user_record = $this->db->isUserInDb($username_email)->fetchAll();
                    // Tcheck in the database if user informations are there.
                    if(count($user_record) == 1){
                        $db_password = $user_record[0]['Password'];
                        # Check the password
                        if(password_verify($password, $db_password)){
                          # Get the id to manage access control correctly
                          $_SESSION['user-id'] = $user_record[0]['Id'];
                          # Get the admin status to manage the admin access control
                          if($user_record[0]['Admin']){
                            $_SESSION['is-admin'] = true;
                          }
                          # Login user
                          header('Location: ' . ROOT_URL . 'admin/');
                        }else{
                           $_SESSION['signin'] = "Please check your input !";
                        }
                    }else{
                        $_SESSION['signin'] = "User not found";
                    }
                }

                # Verify if the is any error
                if(isset($_SESSION['signin'])){
                    $_SESSION['signin-data'] = $_POST;
                    header('Location: ' . ROOT_URL . 'signin.php');
                    die();
                }
            }
            # ========================  ADD-USER REQUEST =========================
            elseif(isset($_POST['add-user'])){
                // Grabbing input elements
                $firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $username =  filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email =  filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                $password =  filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword =  filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $avatar = $_FILES['avatar']; // Is an array
                $userRole = filter_var($_POST['user-role'], FILTER_SANITIZE_NUMBER_INT);

                /*When the input is invalid, I will create a sgnUp SESSION and store the message inside of that. */
                // Inputs validations
                if(!$firstName){
                    $_SESSION['add-user'] = "Please enter a valid first name";
                }
                elseif(!$lastName){
                    $_SESSION['add-user'] = "Please enter a valid last name";
                }
                elseif(!$username){
                    $_SESSION['add-user'] = "Please enter a valid surname";
                }
                elseif(!$email){
                    $_SESSION['add-user'] = "Please enter a valid email";
                }
                elseif(strlen($password) < 8 || strlen($confirmPassword) < 8){
                    $_SESSION['add-user'] = "Password should be 8+ characters";
                }
                elseif(!$avatar['name']){
                    $_SESSION['add-user'] = "Please add an avatar";
                }
                else{
                    # Check passwords matching
                    if($password !== $confirmPassword){
                        $_SESSION['add-user'] = "Password don't match";
                    }
                    else{
                        # Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        # Check if username or email(unique id) already exit in the database
                        if(count($this->db->isUserOrEmailInDb($username, $email)->fetchAll()) > 0){
                            $_SESSION['add-user'] = "Username or email already exist";
                        }else{
                            # ============ Process the avatar ==============
                            $avatar_name = $this->processImage($avatar, 'add-user');                
                        }
                    }
                }
                # If there is any invalid input, put all input in a session and to avoid user retape and when the page refresh 
                # Store the inputs in the database
                if(isset($_SESSION['add-user'])){
                $_SESSION['add-user-data'] = $_POST; // Take the all information in the form
                header('Location: ' . ROOT_URL . 'admin/add-user.php');
                die();
                }else{
                    // Insertion of a new user into users table
                    $insert_user_result = $this->db->insertUser($firstName, $lastName, $username, $email, $hashed_password, $avatar_name, $userRole);     
                    if($insert_user_result){
                        $_SESSION['add-user-success'] = "New user $firstName $lastName added sucessfully !";
                        header('Location: ' . ROOT_URL . 'admin/manage-user.php');
                        die();
                    }

                }  

            }

            # ======================== EDIT-USER REQUEST =========================

            elseif(isset($_POST['edit-user'])){
                # Get user input
                $userName = filter_var($_POST['userName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $status = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
                $user_id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
                
                # Validate inputs
                if(!$userName){
                   $_SESSION['edit-user-error'] = "The user name was invalid";
                }else{
                   if($this->db->editUser($user_id, $userName, $status)){
                    $_SESSION['edit-user-success'] = $userName . " updated sucessfully !";
                   }
                }
                header("Location: " . ROOT_URL . "admin/manage-user.php");
                die();
            }

            # ============================ ADD-CATEGORY REQUEST =================================
            elseif(isset($_POST['add-category'])){
              # Get inputs
              $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
              $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
              
              # Validate inputs
              if(!$title){
                $_SESSION['add-category'] = "Please enter the title ";
              }
              elseif(!$description){
                $_SESSION['add-category'] = "Please enter the description";
              }

              # Tcheck if there any error
              if(isset($_SESSION['add-category'])){
                $_SESSION['add-category-data'] = $_POST;
                header("Location: ". ROOT_URL . 'admin/add-category.php');
                die();
              }else{
                # Insert in the database
                if (!$this->db->isAlreadyCategory($title)){
                    $this->db->insertCategory($title, $description);
                    $_SESSION['add-category-success'] = "$title category added successfully";
                }else{
                    $_SESSION['add-category-error'] = "$title category already exist !";
                }  
               
                header('location: ' . ROOT_URL . 'admin/manage-categories.php');
                die();
              }
            }
            # ============================ EDIT-CATEGORY REQUEST =================================
            elseif(isset($_POST['edit-category'])){
                # Get ctegory input
                $title= filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
                $category_id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
              
                
                # Validate inputs
                if(!$title || !$description){
                   $_SESSION['edit-category-error'] = "The input was invalid ";
                }else{
                   $this->db->editCategory($category_id, $title, $description);
                   $_SESSION['edit-category-success'] = "$title updated sucessfully !";
                      
                }
                header("Location: " . ROOT_URL . "admin/manage-categories.php");
                die();
            }
            
            # ============================ ADD-POST REQUEST =================================
            elseif(isset($_POST['add-post'])){
                # Get the inputs
                $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category_id = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $featured = $_POST['featured'];

                # Verify inputs
                if(!$title){
                    $_SESSION['add-post'] = "Please enter a title";
                }
                elseif(!$description){
                    $_SESSION['add-post'] = "Please enter a content";
                }
                elseif($this->db->getPostTitle($title)){
                    $_SESSION['add-post'] = "This title already exist !";
                }
                else{
                    # Get the image
                    $thumbnail = $_FILES['thumbnail'];
                    if($thumbnail['name']){
                        $thumbnail_name = $this->processImage($thumbnail, 'add-post');
                    }else{
                        $_SESSION['add-post'] = "Please enter a thumbnail";
                    }
                }
                # If there is any error
                if(isset($_SESSION['add-post'])){
                    # Get the input data
                    $_SESSION['add-post-data'] = $_POST;
                    header("Location: " . ROOT_URL . "admin/add-post.php");
                    die();
                }else{
                    # Get data to insert
                    $user_id = $_SESSION['user-id'];
                    $dateTime = date('Y-m-d H:i:s');
                    # Insert in the database
                    if($this->db->insertPost($title, $description, $thumbnail_name, $category_id, $user_id, $dateTime, $featured)){
                        # Set a success message
                        $_SESSION['add-post-success'] = "The post is successfully added !!";
                        header("Location: " . ROOT_URL . "admin/");
                        die();
                    }
                }
            }

            # ============================ EDIT-POST REQUEST =================================
            elseif(isset($_POST['edit-post'])){
                # Get the inputs
                $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category_id = (int)filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $thumbnail = $_FILES['thumbnail'];
                $post_id = (int)$_POST['id'];

                $featured = (int)$_POST['featured'];
                $id = (int)$_POST['id'];
                $previous_thumbnail_name =  $this->db->getPostColumn("Thumbnail", $id);
                # Verify inputs
                if(!$title){
                    $_SESSION['edit-post-error'] = "Title missing, post didn't update";
                }
                elseif(!$description){
                    $_SESSION['edit-post-error'] = "Content missing, post didn't update";
                }else{
                    # Delete exiting thumbnail if new thumnail is available
                    if ($thumbnail['name']) {
                        $previous_thumbnail_path = 'images/' . $previous_thumbnail_name;
                        unlink($previous_thumbnail_path);

                        # Process the image to store it locally
                        $thumbnail_name = $this->processImage($thumbnail, 'edit-post');
                    }
                }

                # Check if there is any error
                if(isset($_SESSION["edit-post-error"])){
                   header("Location: " . ROOT_URL . "admin/");
                   die();
                }else{
                    # Set thumbnail name if a new one was uploaded, else keep old thumbnail name
                    $thumbnail_to_insert = $thumbnail_name ? $thumbnail_name : $previous_thumbnail_name;

                    # Update in the database
                    if($this->db->updatePost($id, $title, $description, $featured, $category_id, $thumbnail_to_insert)){
                        $_SESSION['edit-post-success'] = "$title succesfully edited !";
                    }else{
                        $_SESSION['edit-post-error'] = "$title didn't edited !";
                    }
                    header("Location: " . ROOT_URL . "admin/");
                }
            }
             # ============================ SEARCH-POST REQUEST =================================
            elseif(isset($_POST['search__btn'])){
                # Get the input
                $search = filter_var($_POST['search'], FILTER_SANITIZE_SPECIAL_CHARS);
                if(!$search){
                    $_SESSION['search'] = "Search bar was not filled !";
                }else{
                    $result = $this->db->getSearch($search);
                    if($result){
                        $_SESSION['search-result'] = $result;
                    }else{
                        $_SESSION['search-result-error'] = 'No post found for this search';
                    }
                }
                header('Location: ' . ROOT_URL . "blog.php");
                die();    
            }
        }
        
        # ============================ HANDLE GET REQUEST =================================
        elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
            # Get the request
            $request = explode(';', $_GET['id']);
            # Delete user request
            if($request[0] == 'user'){
                # Get the user from the database
                $user_id = (int)$request[1];
              
                $user = $this->db->getUser((int)$user_id);
                # Delete the avatar
                $avatar_name = $user['Avatar'];
                $avatar_path = 'images/' . $avatar_name;
                unlink($avatar_path);

                # FOR LATER
                # fetch all thumbnails of user's posts and delete them
                
                # Delete the user in the database
                if($this->db->deleteUser($user_id)){
                    $_SESSION['delete-user-success'] = "$user[UserName] is successfully deleted !";
                }
                header("Location: " . ROOT_URL . "admin/manage-user.php");
                die();
            }elseif($request[0] == 'category'){
                # Get category_id
                $category_id = (int)$request[1];
                $category = $this->db->getCategory($category_id);

                # Delete category from the table
                if($this->db->deleteCategory($category_id)){
                    $_SESSION['delete-category-success'] = "$category[Title] is succesfully deleted !";
                    header("Location: " . ROOT_URL . "admin/manage-categories.php");
                    die();
                }
            }elseif($request[0] == 'post'){
                # get post id
                $post_id = (int)$request[1];

                # Get post thumbnail and delete it locally
                $thumbnail_name = $this->db->getPostColumn('Thumbnail', $post_id);        
                $thumbnail_path = 'images/' . $thumbnail_name;
                    unlink($thumbnail_path); # Delete image locally

                # Delete post from the table
                if($this->db->deletePost($post_id)){
                    $_SESSION['delete-post-success'] = "Post is succesfully deleted !";
                    header("Location: " . ROOT_URL . "admin/");
                    die();
                }
            }elseif($request[0] == 'category-post'){
                # Get category-post' id
                $category_post_id = (int)$request[1];
                $_SESSION['category-post-data'] = $this->db->getCategoriesPosts($category_post_id);
                $_SESSION['category-post-category'] = $this->db->getCategory($category_post_id)[0][1];
                var_dump($_SESSION['category-post-category']);
                header("Location: " . ROOT_URL . "category-post.php");
                die();
            }
        }
    }
    # Function to process any image 
    public function processImage($image, $request){
        # ============ Process the avatar ==============
            // Rename the avatar
            $time = time();
            $image_name = $time . $image['name'];
            $image_tmp_path = $image['tmp_name']; // Contains the path location of the image
            $image_destination_path = 'images/' .$image_name;

            // Check if the file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extention = explode('.', $image_name);
            $extention = end($extention);
            if(in_array($extention, $allowed_files)){
                // Size must be less than 1mb
                if($image['size'] < 2000000){
                // Upload avatar
                move_uploaded_file($image_tmp_path, $image_destination_path);
                }else{
                    $_SESSION[$request] = "File too large. Should be less than 1mb";
                }
            }else{
                $_SESSION[$request] = "File should be png, jpg or jpeg";
        }
        return  $image_name;
    }
}

# ============================ Testing part =================================
$myBlog = new blog(new database());

// Run requestHandler
$myBlog->handleRequest();
