<?php
require_once 'boot.php';
require_once 'cookie_handler.php';

$_SESSION['user_id'] = false;
$_SESSION['username'] = false;
$_SESSION['user_role'] = false;
session_destroy();

clearCookies();

header('Location: /');
?>