<?php
require_once 'boot.php';

$_SESSION['user_id'] = false;
$_SESSION['username'] = false;

header('Location: /');
?>