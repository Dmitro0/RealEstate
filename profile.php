<?php
require_once 'src/boot.php';
require_once 'src/helper.php';
$auth = checkAuth();
if (!$auth) {
    header('Location: index.php');
    exit;
}

try {
    $conn = getDbConnection();
    
    $stmt = $conn->prepare('SELECT userrole FROM "Users" WHERE id = :user_id');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $bookingStmt = $conn->prepare('
        SELECT r.id, r.name, r.images, r.costrealty, r.area, r.adress
        FROM "Realty" r 
        JOIN "BookingRealty" b ON r.id = b.realty 
        WHERE b.customer = :customer
    ');
    $bookingStmt->bindParam(':customer', $_SESSION['username']);
    $bookingStmt->execute();
    $bookings = $bookingStmt->fetchAll(PDO::FETCH_ASSOC);
    
    $viewStmt = $conn->prepare('
        SELECT r.id, r.name, r.images, r.costrealty, r.area, r.adress, v.dateview, v.name as contact_name, v.phone as contact_phone 
        FROM "Realty" r 
        JOIN "ViewRealty" v ON r.id = v.realty 
        WHERE v.customer = :customer
    ');
    $viewStmt->bindParam(':customer', $_SESSION['username']);
    $viewStmt->execute();
    $views = $viewStmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Ошибка при получении данных: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Профиль - ДомМаркет</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="modalAuthWindow.css" />
    <link rel="stylesheet" href="profile.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="main-body">
            <div class="main-contain">
                <div class="profile-header">
                    <h1>Личный кабинет</h1>
                    <div class="user-info">
                        <p class="username">Пользователь: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        <p class="user-role">Роль: <?php echo htmlspecialchars($user['userrole'] == 1 ? 'Пользователь' : 'Администратор'); ?></p>
                    </div>
                </div>

                <div class="profile-content">
                    <section class="bookings-section">
                        <h2>Забронированная недвижимость</h2>
                        <?php if (empty($bookings)): ?>
                            <p class="no-items">У вас нет забронированной недвижимости</p>
                        <?php else: ?>
                            <div class="property-grid">
                                <?php foreach ($bookings as $booking): ?>
                                    <div class="property-card">
                                        <img src="<?php echo htmlspecialchars($booking['images']); ?>" alt="<?php echo htmlspecialchars($booking['name']); ?>">
                                        <div class="property-info">
                                            <h3><?php echo htmlspecialchars($booking['name']); ?></h3>
                                            <p class="price"><?php echo number_format((float)$booking['costrealty'], 2, '.', ' '); ?>₽</p>
                                            <p class="area">Площадь: <?php echo htmlspecialchars($booking['area']); ?> м²</p>
                                            <p class="address">Адрес: <?php echo htmlspecialchars($booking['adress']); ?></p>
                                        </div>
                                        <div class="property-actions">
                                            <div class="action-button remove-button" onclick="acceptModal(<?php echo $booking['id']; ?>)">
                                                Отменить бронирование
                                            </div>
                                            <div class="action-button pay-button">
                                                Оплатить
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <section class="views-section">
                        <h2>Назначенные просмотры</h2>
                        <?php if (empty($views)): ?>
                            <p class="no-items">У вас нет назначенных просмотров</p>
                        <?php else: ?>
                            <div class="property-grid">
                                <?php foreach ($views as $view): ?>
                                    <div class="property-card">
                                        <img src="<?php echo htmlspecialchars($view['images']); ?>" alt="<?php echo htmlspecialchars($view['name']); ?>">
                                        <div class="property-info">
                                            <h3><?php echo htmlspecialchars($view['name']); ?></h3>
                                            <p class="price"><?php echo number_format((float)$view['costrealty'], 2, '.', ' '); ?>₽</p>
                                            <p class="area">Площадь: <?php echo htmlspecialchars($view['area']); ?> м²</p>
                                            <p class="address">Адрес: <?php echo htmlspecialchars($view['adress']); ?></p>
                                            <p class="view-date">Дата просмотра: <?php echo date('d.m.Y', strtotime($view['dateview'] . ' +7 days')); ?></p>
                                            <p class="contact">Контактное лицо: <?php echo htmlspecialchars($view['contact_name']); ?></p>
                                            <p class="phone">Телефон: <?php echo htmlspecialchars($view['contact_phone']); ?></p>
                                        </div>
                                        <div class="property-actions">
                                            <div class="action-button remove-button" onclick="removeView(<?php echo $view['id']; ?>)">
                                                Отменить просмотр
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <section class="favourites-section">
                        <h2>Избранная недвижимость</h2>
                        <?php
                        $favouritesStmt = $conn->prepare('
                            SELECT r.id, r.name, r.images, r.costrealty, r.area, r.adress
                            FROM "Realty" r 
                            JOIN "Favourites" f ON r.id = f.realty 
                            WHERE f.customer = :customer
                        ');
                        $favouritesStmt->bindParam(':customer', $_SESSION['username']);
                        $favouritesStmt->execute();
                        $favourites = $favouritesStmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (empty($favourites)): ?>
                            <p class="no-items">У вас нет избранной недвижимости</p>
                        <?php else: ?>
                            <div class="property-grid">
                                <?php foreach ($favourites as $favourite): ?>
                                    <div class="property-card">
                                        <img src="<?php echo htmlspecialchars($favourite['images']); ?>" alt="<?php echo htmlspecialchars($favourite['name']); ?>">
                                        <div class="property-info">
                                            <h3><?php echo htmlspecialchars($favourite['name']); ?></h3>
                                            <p class="price"><?php echo number_format((float)$favourite['costrealty'], 2, '.', ' '); ?>₽</p>
                                            <p class="area">Площадь: <?php echo htmlspecialchars($favourite['area']); ?> м²</p>
                                            <p class="address">Адрес: <?php echo !empty($favourite['adress']) ? htmlspecialchars($favourite['adress']) : 'На вашем участке'; ?></p>
                                        </div>
                                        <div class="property-actions">
                                            <div class="action-button remove-button" onclick="removeFavourite(<?php echo $favourite['id']; ?>)">
                                                Удалить из избранного
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>
                <?php include 'modal.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="scriptsJS/modalAuthWindow.js"></script>
    <script src="scriptsJS/toggleUserModal.js"></script>
    <script src="scriptsJS/authSupport.js"></script>
    <script src="scriptsJS/profile.js"></script>
    <script src="scriptsJS/acceptModal.js"></script>
    <script src="scriptsJS/viewModal.js"></script>
</body>
</html>
