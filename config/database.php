<?php
require'config/constants.php';

class database{
    # Private
    private $pdo;

    # Constructor
    function __construct(){
        # Create a PDO object
        try{
            // Connection to the database
            $this->pdo = new PDO('mysql:host=' . DB_HOST .';dbname='. DB_NAME .';charset=utf8', DB_USER, DB_PWD);
         
            // Set the pdo error mode to exception for better error handling
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            // Handle error
            die('<br> <br>' . '<h1>'. "Connection failed " .'<br>' . $e->getMessage() . '</h1>');
        } 
    }

    # Public
    # ======================== IS USER OR EMAIL IN DB =========================
    public function isUserOrEmailInDb($username, $email){
        $user_check_query = "SELECT* FROM users WHERE username='$username' OR email='$email'";
        return $user_check_result = $this->pdo->query($user_check_query);
    }
    
    # ======================== INSERT USER =========================  
    public function insertUser($firstName, $lastName, $username, $email, $hashed_password, $avatar_name, $userRole){
        $insertUser_query = "INSERT INTO users(FirstName, LastName, UserName, Email, Password, Avatar, Admin) VALUES('$firstName','$lastName', '$username', '$email', '$hashed_password', '$avatar_name', $userRole)";
        return $this->pdo->query($insertUser_query);
    }

    # ======================== IS DATA IN DB =========================
    public function isUserInDb($username_email){
        $identification_query = "SELECT* FROM users WHERE Username='$username_email'OR Email='$username_email'";
        return $this->pdo->query($identification_query);
    }

    # ======================== GET AVATAR =========================
   
    public function getAvatar($user_id){
        $avatar_query = "SELECT Avatar FROM users WHERE Id='$user_id'";
        return $this->pdo->query($avatar_query)->fetchColumn();
    }

    # ======================== GET MANAGE USERS =========================
    public function getManageUsers($curr_id){
        $users_query = "SELECT* FROM users WHERE NOT Id='$curr_id'";
        return $this->pdo->query($users_query)->fetchAll();
    }

    # ======================== GET DISPLAYED USERS =========================
    public function getPostsDisplay(){
       $get_display_users = "SELECT* FROM posts ORDER BY Date_time DESC LIMIT 9";
       return $this->pdo->query($get_display_users)->fetchAll();
    }

    # ======================== GET USERS =========================
    public function getUsers(){
        $users_query = "SELECT* FROM users";
        return $this->pdo->query($users_query)->fetchAll();
    }

    # ======================== GET USER =========================
    public function getUser($user_id){
        $users_query = "SELECT* FROM users WHERE Id='$user_id'";
        return $this->pdo->query($users_query)->fetchAll()[0];
    }
    
    # ======================== EDIT USER =========================
    public function editUser($user_id, $userName, $status){
        $edit_user_query = "UPDATE users SET UserName='$userName', Admin='$status' WHERE Id=$user_id";
        return $this->pdo->query($edit_user_query);
    }

    # ======================== DELETE USER =========================
    public function deleteUser($user_id){
        $delete_user_query = "DELETE FROM users WHERE Id=$user_id";
        return $this->pdo->query($delete_user_query);
    }

    # ======================== INSERT CATEGORY =========================
    public function isAlreadyCategory($title){
        $check_query = "SELECT* FROM categories WHERE Title='$title'";
        $result = $this->pdo->query($check_query)->fetchAll();
        var_dump($result);
        if(count($result) == 1){
            return true;
        }
        return false;
    }

    public function insertCategory($title, $description){
        $insert_category_query = "INSERT INTO categories(Title, Description) VALUES('$title', '$description')";
        return $this->pdo->query($insert_category_query);
   }

    # ======================== GET CATEGORY =========================
    public function getCategories(){
        $get_categories_query = "SELECT* FROM categories";
        return $this->pdo->query($get_categories_query);
    }

    # ======================== GET CATEGORY =========================
    public function getCategory($category_id){
        $category_id_query = "SELECT * FROM categories WHERE Id='$category_id'";
        return $this->pdo->query($category_id_query)->fetchAll();
   }

    # ======================== EDIT CATEGORY =========================
    public function editCategory($category_id, $title, $description){
        $edit_category_query = "UPDATE categories SET Title = '$title', Description='$description' WHERE Id='$category_id'";
        return $this->pdo->query($edit_category_query)->fetchAll()[0];
   }

   # ======================== DELETE CATEGORY =========================
    public function deleteCategory($category_id){
        $delete_category_query = "DELETE FROM categories WHERE Id=$category_id";
        return $this->pdo->query($delete_category_query);
    }
    
    # ======================== INSERT POST =========================
    public function insertPost($title, $description, $thumbnail_name, $category_id, $user_id, $dateTime, $featured){
        $this->updateFeatures();
        $insertUser_query = "INSERT INTO posts(Title, Description, Thumbnail, Category_id, Author_id, Date_time, Is_featured) VALUES('$title', '$description', '$thumbnail_name', '$category_id', '$user_id', '$dateTime', '$featured')";
        return $this->pdo->query($insertUser_query);
   }

    # ======================== INSERT POST =========================
    public function getPosts($user_id){
        $get_post_query = "SELECT* FROM posts WHERE Author_id = $user_id";
        return $this->pdo->query($get_post_query)->fetchAll();
    }

    # ======================== GET CATEGORY TITLE =========================
    public function getCategoryTitle(){
        $get_categoryTitle_query = "SELECT Title FROM categories c JOIN posts p ON c.Id=p.category_id";
        return $this->pdo->query($get_categoryTitle_query);

    }
    
    # ======================== GET POST TITLE =========================
    public function getPostTitle($title){
        $get_post_title_query = "SELECT Title FROM posts WHERE Title = '$title'";
        return $this->pdo->query($get_post_title_query)->fetchColumn();
    }

    # ======================== GET POST ELEMENTS =========================
    public function getPostColumn($table, $id){
        $get_postTitle_query = "SELECT $table FROM posts WHERE Id=$id";
        return $this->pdo->query($get_postTitle_query)->fetchColumn();
    }

    # ======================== UPDATE POST =========================
    public function updatePost($id, $title, $description, $featured, $category_id, $thumbnail_to_insert){
        $update_post_query = "UPDATE posts SET Title = '$title', Description='$description', Is_featured='$featured',  Category_id='$category_id', Thumbnail='$thumbnail_to_insert'  WHERE Id=$id";
        return $this->pdo->query($update_post_query);
    }

    # ======================== DELETE POST =========================
    public function deletePost($post_id){
       $delete_post_query = "DELETE FROM posts WHERE Id=$post_id";
       return $this->pdo->query($delete_post_query);
    }

    # ======================== UPDATE FEATURES =========================
    public function updateFeatures(){
    $update_feature_query = "UPDATE posts SET Is_featured=0";
    return $this->pdo->query($update_feature_query);
    }
    
    # ======================== GET FEATURE =========================
    public function getFeatured(){
        $get_featured = "SELECT* FROM posts WHERE Is_featured = 1";
        return $this->pdo->query($get_featured)->fetchAll()[0] ?? null;
    }
    
    # ======================== GET SEARCH =========================
    public function getSearch($search){
        $get_search_query = "SELECT* FROM posts WHERE title LIKE '%$search%'";
        return $this->pdo->query($get_search_query)->fetchAll();
    }
}
