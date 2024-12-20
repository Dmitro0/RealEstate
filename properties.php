<?php
require_once 'src/boot.php';
$auth = checkAuth();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ДомМаркет</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="sliderMain.css" />
    <link rel="stylesheet" href="modalAuthWindow.css" />
    <link rel="stylesheet" href="backgroundSlider.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=favorite" />
    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
  </head>
  <body>
<main>
<?php
require_once 'src/helper.php';
$conn = getDbConnection();

try {
    $type = '';
    $title = '';
    
    $queryParams = $_GET;
    if (isset($queryParams['type'])) {
        $type = $queryParams['type'];
        switch($type) {
            case 'flat':
                $type = 'Квартира';
                $title = 'Квартиры';
                break;
            case 'house': 
                $type = 'Частный дом';
                $title = 'Частные дома';
                break;
            case 'project':
                $type = 'Проект'; 
                $title = 'Проекты';
                break;
        }
    }

    $conditions = [];
    $params = [];

    if (isset($_GET['type'])) {
        switch($_GET['type']) {
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

    if (isset($_GET['rooms']) && $_GET['rooms'] !== 'placeholder') {
        $conditions[] = 'rooms = :rooms';
        $params[':rooms'] = (int)$_GET['rooms'];
    }

    if (isset($_GET['price_from']) && is_numeric($_GET['price_from'])) {
        $conditions[] = 'CAST(costrealty AS numeric) >= :price_from';
        $params[':price_from'] = (float)$_GET['price_from'];
    }

    if (isset($_GET['price_to']) && is_numeric($_GET['price_to'])) {
        $conditions[] = 'CAST(costrealty AS numeric) <= :price_to';
        $params[':price_to'] = (float)$_GET['price_to'];
    }

    if (isset($_GET['renovation']) && $_GET['renovation'] !== 'placeholder') {
        $conditions[] = 'renovation = :renovation';
        if ($_GET['renovation'] === 'otdelka') {
            $params[':renovation'] = 'С отделкой';
        } else {
            $params[':renovation'] = 'Без отделки';
        }
    }


    if (isset($_GET['area_from']) && is_numeric($_GET['area_from'])) {
        $conditions[] = 'CAST(area AS numeric) >= :area_from';
        $params[':area_from'] = (float)$_GET['area_from'];
    }

    if (isset($_GET['area_to']) && is_numeric($_GET['area_to'])) {
        $conditions[] = 'CAST(area AS numeric) <= :area_to';
        $params[':area_to'] = (float)$_GET['area_to'];
    }

    $sql = 'SELECT id, name, images, CAST(costrealty AS numeric) as costrealty, area, rooms, floors, plotarea, adress FROM "Realty"';

    if (!empty($conditions)) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    if (isset($_GET['sort'])) {
        switch($_GET['sort']) {
            case 'asc':
                $sql .= ' ORDER BY CAST(costrealty AS numeric) ASC';
                break;
            case 'desc':
                $sql .= ' ORDER BY CAST(costrealty AS numeric) DESC';
                break;
        }
    }

    $stmt = $conn->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_properties = count($properties);
    ?>
    
    <div class="main-body" id="main-body">
        <div class="main-contain">
            <h2 class="main-bodyBottom-Content vertical-margin"><?php echo !empty($title) ? $title : 'Вся недвижимость'; ?></h2>
            <ul class="clear-list"></ul>
            <div class="results-container">
                <h3 class="main-bodyBottom-Content-count">
                    Выведено результатов: <?php echo $total_properties; ?>
                </h3>
                <div class="sort-container">
                    <select class="sort-select" id="price-sort" onchange="applySorting(this.value)">
                        <option value="">Сортировка по цене</option>
                        <option value="asc">По возрастанию цены</option>
                        <option value="desc">По убыванию цены</option>
                    </select>
                </div>
            </div>

            <?php
            foreach ($properties as $property) {
                ?>
                <div class="realty-container" data-realty-id="<?php echo $property['id']; ?>">
                    <div class="favourite-button <?php 
                        if(isset($_SESSION['username'])) {
                            $checkFav = $conn->prepare("SELECT customer, realty FROM \"Favourites\" WHERE customer = :customer AND realty = :realty");
                            $checkFav->bindParam(':customer', $_SESSION['username']);
                            $checkFav->bindParam(':realty', $property['id']);
                            $checkFav->execute();
                            if($checkFav->fetch()) echo 'active';
                        }
                    ?>" onclick="toggleFavourite(<?php echo $property['id']; ?>, this)">
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                    <div class="realty-image-container">
                        <img src="<?php echo htmlspecialchars($property['images']); ?>" alt="<?php echo htmlspecialchars($property['name']); ?>">
                    </div>
                    <div class="realty-content-container">
                                
                        <div class="realty-text-container">
                            <div class="title-favourite">
                                <h3 class="realty-title"><?php echo htmlspecialchars($property['name']); ?></h3>
                                
                            </div>
                            <h3 class="realty-price"><?php echo number_format($property['costrealty'], 0, ',', ' '); ?> ₽</h3>
                        </div>
                        <div class="realty-info-container">
                            <ul class="realty-info">
                                <li class="realty-info-item">
                                    <div class="realty-info-item-label">Площадь</div>
                                    <div class="realty-info-item-value area-value"><?php echo htmlspecialchars($property['area']); ?> м²</div>
                                </li>
                                <li class="realty-info-item">
                                    <div class="realty-info-item-label">Комнаты</div>
                                    <div class="realty-info-item-value rooms-value"><?php echo htmlspecialchars($property['rooms']); ?></div>
                                </li>
                                <li class="realty-info-item">
                                    <div class="realty-info-item-label">Этаж<?php echo ($property['plotarea'] ? 'ей' : ''); ?></div>
                                    <div class="realty-info-item-value floors-value"><?php echo htmlspecialchars($property['floors']); ?></div>
                                </li>
                                <?php if (isset($property['plotarea']) && $property['plotarea'] !== null): ?>
                                    <li class="realty-info-item">
                                        <div class="realty-info-item-label">Участок</div>
                                        <div class="realty-info-item-value plotarea-value"><?php echo htmlspecialchars($property['plotarea']); ?></div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="realty-additional-info">
                                <li class="realty-additional-info-item">
                                    <div class="realty-additional-info-item-label">Адрес</div>
                                    <?php if (isset($property['adress']) && $property['adress'] !== null): ?>
                                        <div class="realty-additional-info-item-value address-value"><?php echo htmlspecialchars($property['adress']); ?></div>
                                    <?php else: ?>
                                        <div class="realty-additional-info-item-value">Построим на вашем участке</div>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <div class="realty-buttons-container">
                            <ul class="realty-info-button">
                                <li class="realty-info-button-item additional-info">
                                    <a href="#">Подробнее</a>
                                </li>
                                <li class="realty-info-button-item view">
                                    <a href="javascript:void(0)" onclick="viewModal(<?php echo $property['id']; ?>)">Просмотр</a>
                                </li>
                                <li class="realty-info-button-item booking">
                                    <a href="javascript:void(0)" onclick="bookingModal(<?php echo $property['id']; ?>)">Забронировать</a>
                                </li>
                                </ul>
                                <?php if (isset($_SESSION['user_id'])): 
                        $stmt = $conn->prepare('SELECT userrole FROM "Users" WHERE id = :user_id');
                        $stmt->bindParam(':user_id', $_SESSION['user_id']);
                        $stmt->execute();
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user['userrole'] == 2): ?>
                            <div class="admin-controls">
                                <div class="admin-button edit-button" onclick="makeEditable(this.closest('.realty-container').querySelector('.realty-content-container'))">
                                    Редактировать
                                </div>
                                <div class="admin-button save-button" onclick="saveChanges(<?php echo $property['id']; ?>)">
                                    Сохранить
                                </div>
                                <div class="admin-button delete-button" onclick="deleteRealty(<?php echo $property['id']; ?>)">
                                    Удалить
                                </div>
                            </div>
                        <?php endif; 
                    endif; ?>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <?php
            }
            ?>
        </div>
    <div id="viewModal" class="modalWindow">
        <div class="modal-content">
            <span class="close" onclick="viewModal()"><img src="images/close.png"></span>
            <h2>Заказать просмотр</h2>
            <form id="viewForm" method="POST">
                <input type="hidden" id="customer" name="customer" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                <input type="hidden" id="realty" name="realty" value="">
                <div class="form-group">
                    <label for="name">Ваше имя</label>
                    <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
                </div>
                <div class="form-group">
                    <label for="phone">Номер телефона</label>
                    <input type="tel" id="phone" name="phone" placeholder="Введите ваш номер телефона" required>
                </div>
                <div class="button-container">
                    <div class="submit-btn" id="view-submit-btn" type="submit">Отправить заявку</div>
                </div>
            </form>
        </div>
    </div>
    <div class="modalWindow" id="bookingModal">
        <div class="modal-content">
            <span class="close" onclick="bookingModal()"><img src="images/close.png"></span>
                <h2>Забронировать данную недвижимость?</h2>
                <form id="bookingForm" method="POST">
                    <input type="hidden" id="user" name="user" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                    <input type="hidden" id="realty-id" name="realty-id" value="">
                    <div class="button-container">
                        <div class="submit-btn" id="booking-submit-btn" onclick="bookingSubmit()">Забронировать</div>
                        <div class="cancel-btn" id="booking-cancel-btn" onclick="bookingCancel()">Отмена</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
} catch (PDOException $e) {
        echo "Ошибка при получении данных: " . $e->getMessage();
    }
?>
</main>
<?php include 'footer.php'; ?>
  <script src="scriptsJS/modalAuthWindow.js"></script>
  <script src="scriptsJS/modalRegWindow.js"></script>
  <script src="scriptsJS/authFormValidate.js"></script>
  <script src="scriptsJS/regFormValidate.js"></script>
  <script src="scriptsJS/toggleUserModal.js"></script>
  <script src="scriptsJS/sliderMain.js"></script>
  <script src="scriptsJS/authSupport.js"></script>
  <script src="scriptsJS/viewModal.js"></script>
  <script src="scriptsJS/viewModalValidate.js"></script>
  <script src="scriptsJS/bookingModal.js"></script>
  <script src="scriptsJS/profile.js"></script>
  <script src="scriptsJS/sorting.js"></script>
  <script src="scriptsJS/adminRealty.js"></script>
  
</html>