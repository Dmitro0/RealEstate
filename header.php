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
                                <div class="profile-button" onclick="window.location.href='profile.php'">Профиль</div>
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
                            <h2 id="nameOfModalWindow">Авторизация</h2>
                            <form class="auth-form" method="post">
                                <label for="login">Имя пользователя</label>
                                <input type="text" id="login" name="login" placeholder="Введите логин" required>
                                <span class="error-message-login" id="login-error"></span>
                                <label for="password">Пароль</label>
                                <input type="password" id="password" name="password" placeholder="Введите пароль" required>
                                <span class="error-message-login-password" id="password-error"></span>
                                <div class="error-message-auth display-none" id="auth-error">Неверный логин или пароль</div>
                                <div class="button-container">
                                    <div class="auth-form-button" id="submit-button" type="submit">Войти</div>
                                    <a class="auth-form-register" href="#" onclick="toggleRegistrationModal()">Зарегистрироваться</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="registrationModal" class="modalWindow">
                        <div class="auth-modal-content">
                            <span class="close" onclick="closeRegistrationModal()"><img src="images/close.png"></span>
                            <h2 id="nameOfModalWindow">Регистрация</h2>
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
                                    <div class="auth-form-button" id="registration-button" type="submit">Зарегистрироваться</div>
                                    <a class="auth-form-register" href="#" onclick="toggleRegistrationModal()">Уже есть аккаунт? Войти.</a>
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
    <div class="headerBottom">
        <div class="main-contain">
            <a href="index.php">
                <img src="images/full-logo.png" alt="ДомМаркет логотип" class="logo" />
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