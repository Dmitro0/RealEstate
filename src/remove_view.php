<?php
require_once 'helper.php';
require_once 'boot.php';

if (!isset($_SESSION['user_id'])) {
    echo "auth_required";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $realty_id = $_POST['realty_id'] ?? null;
    $customer = $_SESSION['username'];

    if (!$realty_id) {
        echo "error";
        exit;
    }

    try {
        $conn = getDbConnection();
        $stmt = $conn->prepare("DELETE FROM \"ViewRealty\" WHERE customer = :customer AND realty = :realty");
        $stmt->bindParam(':customer', $customer);
        $stmt->bindParam(':realty', $realty_id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        echo "error";
    }
}
?> 