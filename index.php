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
            <li class="item"><a href="index.php">Услуги</a></li>
            <li class="item"><a href="index.php">О компании</a></li>
            <li class="item"><a href="index.php">Контакты</a></li>
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
      <div class="main-body" id="main-body">
        <div class="main-bodyTop">
          <div class="main-contain">
              <p class="intro_title">Знаем что показывать!</p>
              <p class="intro_subtitle">Безупречная репутация на рынке недвижимости</p>
            <div class="filter-container">
              <form class="filter-form" action="" method="get" accept-charset="utf-8">
                <div class="filter-row">
                  <div class="filter-item type-object">
                      <select class="select-list" name="selectlist" id="type-object">
                        <option value="placeholder">Тип объекта</option>
                        <option value="flat">Квартира</option>
                        <option value="house">Дом</option>
                        <option value="project">Проект</option>
                        <option value="complex">Комплекс</option>
                        <option value="land">Участок</option>
                      </select>
                  </div>
                  <div class="filter-item type-flat">
                      <select class="select-list" name="selectlist" id="type-flat">
                        <option value="placeholder">Тип квартиры</option>
                        <option value="flat">Квартира</option>
                        <option value="studio">Студия</option>
                        <option value="penthouse">Пентхаус</option>
                        <option value="loft">Лофт</option>
                      </select>
                  </div>
                  <div class="filter-item rooms">
                      <select class="select-list" name="selectlist" id="rooms">
                        <option value="placeholder">Комнат</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>
                  </div>
                  <div class="filter-item-input price">
                    <div class="price-container">
                      <input type="number" class="price-input" placeholder="Цена от" min="0">
                      <input type="number" class="price-input" placeholder="Цена до" min="0">
                    </div>
                  </div>
                </div>
                <div class="filter-row">
                  <div class="filter-item otdelka">
                    <select class="select-list" name="selectlist" id="otdelka">
                      <option value="placeholder">Отделка</option>
                      <option value="otdelka">C отделкой</option>
                      <option value="nedodelka">Частичная</option>
                      <option value="absolutely">Без отделки</option>
                    </select>
                  </div>
                  <div class = "filter-item city">
                    <select class="select-list" name="selectlist" id="city">
                      <option value="placeholder">Город</option>
                      <option value="city">Москва</option>
                      <option value="city">Санкт-Петербург</option>
                    </select>
                  </div>
                  <div class="filter-item-input area">
                    <div class="area-container">
                    <input type="number" class="area-input" placeholder="Площадь от" min="0">
                      <input type="number" class="area-input" placeholder="Площадь до" min="0">
                    </div>
                  </div>
                  <div class="filter-item-button">
                    <div class="show-button" type="submit">Показать <span class="result-count">2538</span></div>
                  </div>
                  <div class="filter-item-reset">
                    <div class="reset-button" type = "clear">Сбросить</div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="main-contain">
          <p class="main-bodyBottom-Content">Виды недвижимости</p>
          <div class="categories">
            <div class="front-block">
              <div class="block flat">
                <a href="page.html">
                  <div class="block-content">Купить квартиру</div>
                  <div class="count">2500 квартир</div>
                </a>
              </div>
              <div class="block house">
                <a href="properties.php">
                  <div class="block-content">Купить частный дом</div>
                  <div class="count">1000 коттеджей</div>
                </a>
              </div>
              <div class="block project">
                <a href="page.html">
                  <div class="block-content">Будущие проекты в мире недвижимости</div>
                  <div class="count">100 проектов</div>
                </a>
              </div>
            </div>

            <div class="actual-slider">
            <p class = "main-bodyBottom-Content">Актульные предложения</p>
            <button class="slider-button prev" onclick="moveSlide(-1)"><img src="images/chevron_left.png"></button>
            <button class="slider-button next" onclick="moveSlide(1)"><img src="images/chevron_right.png"></button>
            <div class="slider-container">
              <div class="slider">
                <div class="slide">
                  <img src="images/house1.jpg" alt="Дом 1">
                  <div class="slide-content">
                    <div class="slide-price">15 500 000 ₽</div>
                    <div class="slide-details">
                      <p>Площадь: 173 м²</p>
                      <p>Район: Щаповское поселение, г. Москва</p>
                    </div>
                  </div>
                </div>
                
                <div class="slide">
                  <img src="images/house2.jpg" alt="Дом 2">
                  <div class="slide-content">
                    <div class="slide-price">23 800 000 ₽</div>
                    <div class="slide-details">
                      <p>Площадь: 230 м²</p>
                      <p>Район: г. Москва</p>
                    </div>
                  </div>
                </div>
                
                <div class="slide">
                  <img src="images/house3.jpg" alt="Дом 3">
                  <div class="slide-content">
                    <div class="slide-price">79 900 000 ₽</div>
                    <div class="slide-details">
                      <p>Площадь: 430 м²</p>
                      <p>Район: поселок Крекшино, г. Москва</p>
                    </div>
                  </div>
                </div>
                
                <div class="slide">
                  <img src="images/house4.jpg" alt="Дом 4">
                  <div class="slide-content">
                    <div class="slide-price">168 000 000 ₽</div>
                    <div class="slide-details">
                      <p>Площадь: 552 м²</p>
                      <p>Район: поселок Чистые ключи, г. Москва</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>

        <div class="main-bodyBottomInfo">
          <div class="main-contain">
            <div class="main-bodyBottomInfo-text">
              <div class="list-container">
              <p class = "main-bodyBottomInfo-title">Информация</p>
              <hr class="line">
              <ul class = "main-bodyBottomInfo-list">
                <li><a href="#">О компании</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="#">Вакансии</a></li>
                <li><a href="#">Права</a></li>
                </ul>
              </div>
              <div class="list-container">
                <p class = "main-bodyBottomInfo-title">Городская</p>
                <hr class="line">
                <ul class = "main-bodyBottomInfo-list">
                  <li><a href="#">Жилые комплексы</a></li>
                  <li><a href="#">Новостройки</a></li>
                  <li><a href="#">Проекты</a></li>
                </ul>
              </div>
              <div class="list-container">
                <p class = "main-bodyBottomInfo-title">Загородная</p>
                <hr class="line">
                <ul class = "main-bodyBottomInfo-list">
                  <li><a href="#">Коттеджные поселки</a></li>
                  <li><a href="#">Коттеджи</a></li>
                  <li><a href="#">Участки</a></li>
                </ul>
              </div>
              <div class="list-container">
                <p class = "main-bodyBottomInfo-title">Новостройки</p>
                <hr class="line">
                <ul class = "main-bodyBottomInfo-list">
                  <li><a href="#">Экслюзивно на нашем сайте</a></li>
                  <li><a href="#">Выгодные предложения</a></li>
                  <li><a href="#">Новостройки в ипотеку</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <footer>
      <div class="main-contain">
      <div class="footer-info">
        <p>© 2024 «ДомМаркет»</p>
        <p>Дизайн и разработка: rsreu.ru группа 246 бригада 9</p>
        <p>Адрес: ул. Гагарина, 59</p>
      </div>
    </div>
    </footer>
  <script src="scriptsJS/modalAuthWindow.js"></script>
  <script src="scriptsJS/modalRegWindow.js"></script>
  <script src="scriptsJS/authFormValidate.js"></script>
  <script src="scriptsJS/regFormValidate.js"></script>
  <script src="scriptsJS/toggleUserModal.js"></script>
  <script src="scriptsJS/sliderMain.js"></script>
  <script src="scriptsJS/authSupport.js"></script>
  </body>
</html>
