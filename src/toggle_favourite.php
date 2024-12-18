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
        
        $checkStmt = $conn->prepare("SELECT customer, realty FROM \"Favourites\" WHERE customer = :customer AND realty = :realty");
        $checkStmt->bindParam(':customer', $customer);
        $checkStmt->bindParam(':realty', $realty_id);
        $checkStmt->execute();
        
        if ($checkStmt->fetch()) {
            $stmt = $conn->prepare("DELETE FROM \"Favourites\" WHERE customer = :customer AND realty = :realty");
            $action = "removed";
        } else {
            $stmt = $conn->prepare("INSERT INTO \"Favourites\" (datefav,customer, realty) VALUES (NOW(), :customer, :realty)");
            $action = "added";
        }
        
        $stmt->bindParam(':customer', $customer);
        $stmt->bindParam(':realty', $realty_id);
        
        if ($stmt->execute()) {
            echo $action;
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        echo "error";
    }
}
?> 