<?php
require_once 'src/boot.php';
$auth = checkAuth();
?>

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
    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
  </head>
  <body>
    <header id="header">
      <div class="headerTop">
        <div class="main-contain">
          <div class="socials">
            <img src="images/vk.png" alt="ВКонтакте" class="vk" />
            <img src="images/youtube3.png" alt="YouTube" class="youtube" />
          </div>

          <ul class="header-menu-up">
            <li class="item"><a href="index.html">Услуги</a></li>
            <li class="item"><a href="index.html">О компании</a></li>
            <li class="item"><a href="index.html">Контакты</a></li>
            <li>
              <?php if ($auth): ?>
                <div class="user" onclick="toggleUserModal()">
                  <img src="images/user.png" alt="Профиль" />
                  <span class="user-text" id="user-text"><?php echo $_SESSION['username']; ?></span>
                </div>
                <div id="userModal" class="userModalWindow">
                  <div class="user-modal-content">
                    <div class="logout-button" onclick="logout()">Выйти</div>
                  </div>
                </div>
              <?php else: ?>
                <div class="user" onclick="toggleAuthModal()">
                  <span class="user-text" id="user-text"></span>
                  <img src="images/user.png" alt="Профиль" />
                </div>
              <?php endif; ?>


              <div id="authModal" class="modalWindow">
                <div class="auth-modal-content">
                  <span class="close" onclick="toggleAuthModal()"><img src="images/close.png"></span>
                  <h2 id = "nameOfModalWindow">Авторизация</h2>
                  <form class="auth-form" method="post">
                    <label for="login">Имя пользователя</label>
                    <input type="text" id="login" name="login" placeholder="Введите логин" required>
                    <span class="error-message-login" id="login-error"></span>
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль" required>
                    <span class="error-message-login-password" id="password-error"></span>
                    <div class="error-message-auth display-none" id="auth-error">Неверный логин или пароль</div>
                    <div class="button-container">
                      <div class="auth-form-button" id = "submit-button" type="submit">Войти</div>
                      <a class="auth-form-register" href="#" onclick = "toggleRegistrationModal()">Зарегистрироваться</a>
                    </div>
                  </form>
                </div>
              </div>

                <div id="registrationModal" class="modalWindow">
                  <div class="auth-modal-content">
                    <span class="close" onclick="closeRegistrationModal()"><img src="images/close.png"></span>
                    <h2 id = "nameOfModalWindow">Регистрация</h2>
                    <form class="auth-form" id="registration-form" method="post">
                      <label for="reg-login">Имя пользователя</label>
                      <input type="text" id="reg-login" name="reg-login" placeholder="Введите логин" required>
                      <span class="error-message-login" id="reg-login-error"></span>

                      <label for="email">E-mail</label>
                      <input type="text" id="email" name="email" placeholder="Введите e-mail" required>
                      <span class="error-message-email" id="error-message-email"></span>

                      <label for="reg-password">Пароль</label>
                      <input type="password" id="reg-password" name="reg-password" placeholder="Введите пароль" required>
                      <span class="error-message-password" id="reg-password-error"></span>
                      
                      <label for="repeat-password">Повторите пароль</label>
                      <input type="password" id="repeat-password" name="repeat-password" placeholder="Повторите пароль" required>
                      <span class="error-message-password" id="reg-repeat-password-error"></span>


                      <div class="button-container">
                        <div class="auth-form-button" id = "registration-button" type="submit" >Зарегистрироваться</div>
                        <a class="auth-form-register" href="#" onclick = "toggleRegistrationModal()">Уже есть аккаунт? Войти.</a>
                      </div>
                    </form>
                    <div class="success-message-registration display-none" id="registration-success">Регистрация прошла успешно!</div>
                    <div class="error-message-registration display-none" id="registration-error">Пользователь с таким логином уже зарегистрирован!</div>
                  </div>

              </div>
            </li>
          </ul>
          </div>
        </div>
      </div>
      <div class="headerBottom">
        <div class="main-contain">
          <a href="index.php">
            <img
              src="images/full-logo.png"
              alt="ДомМаркет логотип"
              class="logo"
            />
          </a>
          
          <ul class="header-menu-bottom">
            <li class="header-menu-item rent"><a href="#">Аренда</a>
              <div class="hidden-menu">
                <ul class="header-menu rent">
                  <li class="header-menu-item"><a href="#">Снять квартиру</a></li>
                  <li class="header-menu-item"><a href="#">Снять дом</a></li>
                  <li class="header-menu-item"><a href="#">Снять участок</a></li>
                  <li class="header-menu-item"><a href="#">Снять коммерческую</a></li>
                  <li class="header-menu-item"><a href="#">Снять офис</a></li>
                </ul>
              </div>
            </li>
            <li class="header-menu-item sale"><a href="#">Продажа</a>
              <div class="hidden-menu">
                <ul class="header-menu sale">
                  <li class="header-menu-item"><a href="#">Купить квартиру</a></li>
                  <li class="header-menu-item"><a href="#">Купить дом</a></li>
                  <li class="header-menu-item"><a href="#">Купить участок</a></li>
                </ul>
              </div>
            </li>
            <li class="header-menu-item new-buildings"><a href="#">Новостройки</a>
              <div class="hidden-menu">
                <ul class="header-menu new-buildings">
                  <li class="header-menu-item"><a href="#">Экслюзивно на нашем сайте</a></li>
                  <li class="header-menu-item"><a href="#">Выгодные предложения</a></li>
                  <li class="header-menu-item"><a href="#">Новостройки в ипотеку</a></li>
                </ul>
              </div>
            </li>
            <li class="header-menu-item city"><a href="#">Городская</a>
              <div class="hidden-menu">
                <ul class="header-menu city">
                  <li class="header-menu-item"><a href="#">Жилые комплексы</a></li>
                  <li class="header-menu-item"><a href="#">Новостройки</a></li>
                  <li class="header-menu-item"><a href="#">Проекты</a></li>
                  <li class="header-menu-item"><a href="#">Строительные компании</a></li>
                </ul>
              </div>
            </li>
            <li class="header-menu-item country"><a href="#">Загородная</a>
              <div class="hidden-menu">
                <ul class="header-menu country">
                  <li class="header-menu-item"><a href="#">Коттеджные поселки</a></li>
                  <li class="header-menu-item"><a href="#">Коттеджи</a></li>
                  <li class="header-menu-item"><a href="#">Пентхаусы</a></li>
                  <li class="header-menu-item"><a href="#">Таунхаусы</a></li>
                  <li class="header-menu-item"><a href="#">Участки</a></li>
                </ul>
              </div>
            </li>
            <li><div class="button-call">Позвоните мне</div></li>
          </ul>
      </div>
      </div>
    </header>
<main>
<?php
require_once 'src/helper.php';
$conn = getDbConnection();

try {
    // Получаем все объекты недвижимости из базы данных
    $stmt = $conn->prepare('SELECT id, name, images, CAST(costrealty AS numeric) as costrealty, area, rooms, floors, plotarea, adress FROM "Realty"');
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Получаем общее количество записей
    $total_properties = count($properties);
    ?>
    
    <div class="main-body" id="main-body">
        <div class="main-contain">
            <h2 class="main-bodyBottom-Content vertical-margin">Элитные квартиры</h2>
            <ul class="clear-list"></ul>
            <h3 class="main-bodyBottom-Content-count vertical-margin">
                Выведено результатов: <?php echo $total_properties; ?>
            </h3>

            <?php
            // Перебираем все записи и создаем для каждой блок
            foreach ($properties as $property) {
                ?>
                <div class="realty-container">
                    <div class="realty-image-container">
                        <img src="<?php echo htmlspecialchars($property['images']); ?>" alt="<?php echo htmlspecialchars($property['name']); ?>">
                    </div>
                    <div class="realty-content-container">
                        <div class="realty-text-container">
                            <h3 class="realty-title"><?php echo htmlspecialchars($property['name']); ?></h3>
                            <h3 class="realty-price"><?php echo number_format($property['costrealty'], 0, ',', ' '); ?> ₽</h3>
                        </div>
                        <div class="realty-info-container">
                            <ul class="realty-info">
                                <li class="realty-info-item">
                                    <div class="realty-info-item-label">Площадь</div>
                                    <div class="realty-info-item-value"><?php echo htmlspecialchars($property['area']); ?> кв.м</div>
                                </li>
                                <li class="realty-info-item">
                                    <div class="realty-info-item-label">Комнаты</div>
                                    <div class="realty-info-item-value"><?php echo htmlspecialchars($property['rooms']); ?> комнаты</div>
                                </li>
                                <li class="realty-info-item">
                                    <div class="realty-info-item-label">Этаж</div>
                                    <div class="realty-info-item-value"><?php echo htmlspecialchars($property['floors']); ?> этажей</div>
                                </li>
                                <?php if (isset($property['plotarea']) && $property['plotarea'] !== null): ?>
                                    <li class="realty-info-item">
                                        <div class="realty-info-item-label">Участок</div>
                                        <div class="realty-info-item-value"><?php echo htmlspecialchars($property['plotarea']); ?> соток</div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="realty-additional-info">
                                <li class="realty-additional-info-item">
                                    <div class="realty-additional-info-item-label">Адрес</div>
                                    <div class="realty-additional-info-item-value"><?php echo htmlspecialchars($property['adress']); ?></div>
                                </li>
                            </ul>
                            <ul class="realty-info-button">
                                <li class="realty-info-button-item additional-info">
                                    <a href="property_details.php?id=<?php echo $property['id']; ?>">Подробнее</a>
                                </li>
                                <li class="realty-info-button-item view">
                                    <a href="property_view.php?id=<?php echo $property['id']; ?>">Просмотр</a>
                                </li>
                                <li class="realty-info-button-item booking">
                                    <a href="property_booking.php?id=<?php echo $property['id']; ?>">Забронировать</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} catch (PDOException $e) {
        echo "Ошибка при получении данных: " . $e->getMessage();
    }
?>
</main>
  <script src="scriptsJS/modalAuthWindow.js"></script>
  <script src="scriptsJS/modalRegWindow.js"></script>
  <script src="scriptsJS/authFormValidate.js"></script>
  <script src="scriptsJS/regFormValidate.js"></script>
  <script src="scriptsJS/toggleUserModal.js"></script>
  <script src="scriptsJS/sliderMain.js"></script>
  <script src="scriptsJS/authSupport.js"></script>
</html>