<?php
require_once 'helper.php';
require_once 'boot.php';

if (!isset($_SESSION['user_id'])) {
    echo "auth_required";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $realty = (int)$_POST['realty'] ?? null;
    $customer = $_POST['customer'] ?? null;
    if (empty($name) || empty($phone) || empty($realty) || empty($customer)) {
        echo "error: Пусто". "Имя: ". $name . "Телефон: ". $phone . "Недвижимость: ". $realty . "Пользователь: ". $customer;
        exit;
    }

    try {
        $conn = getDbConnection();
        
        $stmt = $conn->prepare("INSERT INTO \"ViewRealty\" (customer, realty, name, phone, dateview) VALUES (:customer, :realty, :name, :phone, NOW())");
        
        $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
        $stmt->bindParam(':realty', $realty, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error" . $stmt->errorInfo()[2];
        }
        
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    }
} else {
    echo "error" . $_SERVER['REQUEST_METHOD'];
}
?>
