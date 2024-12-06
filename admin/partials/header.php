<?php
require'../partials/header.php';

/* ======= I will control the access of the dashboard here ======= */
if(!isset($_SESSION['user-id'])){
    header("Location: " . ROOT_URL . 'signin.php');
    die();
}
?>
