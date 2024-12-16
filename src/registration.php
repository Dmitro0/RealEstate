<?php
require_once 'boot.php';
require_once 'helper.php';

$login = $_POST['reg-login'];
$password = $_POST['reg-password'];
$email = $_POST['email'];
$password = password_hash($password, PASSWORD_DEFAULT);

$conn = getDbConnection();

$sql = 'INSERT INTO "Users" ("userrole", "login", "userpassword", "email") VALUES (1, :login, :password, :email)';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':email', $email);
try {
    if ($stmt->execute() === true) {
        echo 'success';
    } else {
        echo 'error';
    }
} catch (PDOException $e) {
    echo 'error';
}

?>