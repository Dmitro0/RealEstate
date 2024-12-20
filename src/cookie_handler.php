<?php
function setCookies($user_id, $username, $user_role) {
    $expiry = time() + (30 * 24 * 60 * 60);
    
    setcookie('user_id', $user_id, [
        'expires' => $expiry,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    setcookie('username', $username, [
        'expires' => $expiry,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    setcookie('user_role', $user_role, [
        'expires' => $expiry,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
}

function clearCookies() {
    setcookie('user_id', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true
    ]);
    
    setcookie('username', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true
    ]);
    
    setcookie('user_role', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true
    ]);
} 