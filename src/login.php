<?php
require_once 'boot.php';
require_once 'helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login'];
    $password = $_POST['password'];
    $conn = getDbConnection();
    
    $stmt = $conn->prepare("SELECT id, login, userpassword, userrole FROM \"Users\" WHERE login = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $result = $stmt->fetch();
        
    if ($result && password_verify($password, $result['userpassword'])) {
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $result['id']; 
        $_SESSION['username'] = $result['login'];
        $_SESSION['user_role'] = $result['userrole'];
        $_SESSION['logged_in'] = true;
            
        echo "success";
    } else {
        echo "error";
    }

}
?>