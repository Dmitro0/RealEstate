<?php
require_once 'src/helper.php';
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
    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
  </head>
  <body>
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
                      </select>
                  </div>
                  <div class="filter-item type-flat">
                      <select class="select-list" name="selectlist" id="type-flat">
                        <option value="placeholder">Тип квартиры</option>
                        <option value="flat">Квартира</option>
                      </select>
                  </div>
                  <div class="filter-item rooms">
                      <select class="select-list" name="selectlist" id="rooms">
                        <option value="placeholder">Комнат</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
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
                      <option value="nootdelka">Без отделки</option>
                    </select>
                  </div>
                  <div class = "filter-item city">
                    <select class="select-list" name="selectlist" id="city">
                      <option value="placeholder">Город</option>
                      <option value="city">г. Москва</option>
                    </select>
                  </div>
                  <div class="filter-item-input area">
                    <div class="area-container">
                    <input type="number" class="area-input" placeholder="Площадь от" min="0">
                      <input type="number" class="area-input" placeholder="Площадь до" min="0">
                    </div>
                  </div>
                  <div class = "filter-buttons">
                  <div class="filter-item-button">
                    <a href="properties.php" class="show-button">Показать <span class="result-count"><?php
                        $conn = getDbConnection();
                        $stmt = $conn->query('SELECT COUNT(*) FROM "Realty"');
                        echo $stmt->fetchColumn();
                    ?></span></a>
                  </div>
                  <div class="filter-item-reset">
                    <div class="reset-button" type = "clear">Сбросить</div>
                  </div>
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
                <a href="properties.php?type=flat">
                  <div class="block-content">Купить квартиру</div>
                  <div class="count">2500 квартир</div>
                </a>
              </div>
              <div class="block house">
                <a href="properties.php?type=house">
                  <div class="block-content">Купить частный дом</div>
                  <div class="count">1000 коттеджей</div>
                </a>
              </div>
              <div class="block project">
                <a href="properties.php?type=project">
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
          <div class="main-about">
            <h2 class="main-bodyBottom-Content">О компании</h2>
            <div class="main-about-text-container">
              <p class="main-about-text">ДомМаркет — это крупнейший сервис по продаже и аренде недвижимости в России. Мы предлагаем широкий спектр услуг, включая поиск и бронирование объектов, консультации по недвижимости, а также помощь в оформлении сделок.</p>
              <p class="main-about-text">Мы работаем на рынке недвижимости более 10 лет и имеем огромный опыт в этой сфере. Мы предлагаем широкий спектр услуг, включая поиск и бронирование объектов, консультации по недвижимости, а также помощь в оформлении сделок.</p>
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
                  <li><a href="#">Новостройки в ип��теку</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
<?php include 'footer.php'; ?>
  <script src="scriptsJS/modalAuthWindow.js"></script>
  <script src="scriptsJS/modalRegWindow.js"></script>
  <script src="scriptsJS/authFormValidate.js"></script>
  <script src="scriptsJS/regFormValidate.js"></script>
  <script src="scriptsJS/toggleUserModal.js"></script>
  <script src="scriptsJS/sliderMain.js"></script>
  <script src="scriptsJS/authSupport.js"></script>
  <script src="scriptsJS/filter.js"></script>
  </body>
</html>
