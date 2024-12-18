<?php
require_once 'helper.php';
require_once 'boot.php';

try {
    $conn = getDbConnection();
    
    $conditions = [];
    $params = [];
    
    $sql = 'SELECT COUNT(*) FROM "Realty" WHERE 1=1';
    
    if (!empty($_POST['type_object'])) {
        switch($_POST['type_object']) {
            case 'flat':
                $conditions[] = 'typeRealty = :type';
                $params[':type'] = 'Квартира';
                break;
            case 'house':
                $conditions[] = 'typeRealty = :type';
                $params[':type'] = 'Частный дом';
                break;
            case 'project':
                $conditions[] = 'typeRealty = :type';
                $params[':type'] = 'Проект';
                break;
        }
    }
    
    if (!empty($_POST['rooms']) && $_POST['rooms'] !== 'placeholder') {
        $conditions[] = 'rooms = :rooms';
        $params[':rooms'] = (int)$_POST['rooms'];
    }
    
    if (!empty($_POST['price_from']) && is_numeric($_POST['price_from'])) {
        $conditions[] = 'CAST(costrealty AS numeric) >= :price_from';
        $params[':price_from'] = (float)$_POST['price_from'];
    }
    if (!empty($_POST['price_to']) && is_numeric($_POST['price_to'])) {
        $conditions[] = 'CAST(costrealty AS numeric) <= :price_to';
        $params[':price_to'] = (float)$_POST['price_to'];
    }
    
    if (!empty($_POST['renovation']) && $_POST['renovation'] !== 'placeholder') {
        $conditions[] = 'renovation = :renovation';
        if ($_POST['renovation'] === 'otdelka') {
            $params[':renovation'] = 'С отделкой';
        } else {
            $params[':renovation'] = 'Без отделки';
        }
    }
    
    if (!empty($_POST['area_from']) && is_numeric($_POST['area_from'])) {
        $conditions[] = 'CAST(area AS numeric) >= :area_from';
        $params[':area_from'] = (float)$_POST['area_from'];
    }
    if (!empty($_POST['area_to']) && is_numeric($_POST['area_to'])) {
        $conditions[] = 'CAST(area AS numeric) <= :area_to';
        $params[':area_to'] = (float)$_POST['area_to'];
    }
    
    if (!empty($conditions)) {
        $sql .= ' AND ' . implode(' AND ', $conditions);
    }
    
    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    echo json_encode(['count' => $count]);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 