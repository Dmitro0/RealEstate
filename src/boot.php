<?php
session_start();
require_once 'cookie_handler.php';

function checkAuth() {

    if (isset($_SESSION['user_id'])) {
        return true;
    }
    
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['user_role'])) {

        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['user_role'] = $_COOKIE['user_role'];
        return true;
    }
    
    return false;
}
?>