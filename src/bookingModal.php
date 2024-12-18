<?php
require_once 'helper.php';
require_once 'boot.php';

if (!isset($_SESSION['user_id'])) {
    echo "auth_required";
    exit;
}

$user = $_SESSION['username'];
$realtyId = isset($_POST['realty-id']) ? (int)$_POST['realty-id'] : null;

if (!$realtyId) {
    echo "error: Не указан ID объекта недвижимости";
    exit;
}

try {
    $conn = getDbConnection();
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM \"BookingRealty\" WHERE customer = :customer AND realty = :realty");
    $checkStmt->bindParam(':customer', $user);
    $checkStmt->bindParam(':realty', $realtyId, PDO::PARAM_INT);
    $checkStmt->execute();
    
    if ($checkStmt->fetchColumn() > 0) {
        echo "error: Вы уже забронировали этот объект недвижимости";
        exit;
    }
    $sql = "INSERT INTO \"BookingRealty\" (customer, realty) VALUES (:customer, :realty)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer', $user);
    $stmt->bindParam(':realty', $realtyId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
?>