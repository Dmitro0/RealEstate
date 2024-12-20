<?php
require_once 'helper.php';
require_once 'boot.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Требуется авторизация']);
    exit;
}

$conn = getDbConnection();
$stmt = $conn->prepare('SELECT userrole FROM "Users" WHERE id = :user_id');
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user['userrole'] != 2) {
    echo json_encode(['status' => 'error', 'message' => 'Недостаточно прав']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    try {
        // Удаляем связанные записи
        $conn->beginTransaction();
        
        $stmt = $conn->prepare("DELETE FROM \"Favourites\" WHERE realty = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $stmt = $conn->prepare("DELETE FROM \"ViewRealty\" WHERE realty = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $stmt = $conn->prepare("DELETE FROM \"BookingRealty\" WHERE realty = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Удаляем саму недвижимость
        $stmt = $conn->prepare("DELETE FROM \"Realty\" WHERE id = :id");
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            $conn->commit();
            echo json_encode(['status' => 'success']);
        } else {
            $conn->rollBack();
            echo json_encode(['status' => 'error', 'message' => 'Ошибка при удалении']);
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?> 