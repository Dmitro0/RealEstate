<?php
session_start();

function checkAuth() {
    return !!($_SESSION['user_id'] ?? false);
}
?>