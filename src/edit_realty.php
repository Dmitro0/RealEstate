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
    $name = $_POST['name'] ?? '';
    $costrealty = $_POST['costrealty'] ?? '';
    $area = $_POST['area'] ?? '';
    $rooms = $_POST['rooms'] ?? '';
    $floors = $_POST['floors'] ?? '';
    $plotarea = $_POST['plotarea'] ?? null;
    $adress = $_POST['adress'] ?? '';

    try {
        $sql = "UPDATE \"Realty\" SET 
                name = :name,
                costrealty = :costrealty,
                area = :area,
                rooms = :rooms,
                floors = :floors,
                plotarea = :plotarea,
                adress = :adress
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':costrealty', $costrealty);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':rooms', $rooms);
        $stmt->bindParam(':floors', $floors);
        $stmt->bindParam(':plotarea', $plotarea);
        $stmt->bindParam(':adress', $adress);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ошибка при обновлении']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?> 