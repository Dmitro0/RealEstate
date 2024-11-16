$(document).ready(function() {
    const $login = $('#login');
    const $password = $('#password');

    $('#login-error').hide();
    $('#password-error').hide();
    let usernameError = true;
    $('#login').keyup(function() {
        validateUsername();
    });

    function validateUsername() {
        // Валидация логина
        if (!$login.val().trim()) {
            usernameError = false;
            $('#login-error').text('Введите логин').show();
            $login.css('border-color', 'red');
        } else if ($login.val().length < 4) {
            usernameError = false;
            $('#login-error').text('Логин должен содержать минимум 4 символа').show();
            $login.css('border-color', 'red');
        } else {
            usernameError = true;
            $('#login-error').hide();
            $login.css('border-color', '');
        }
    }

    let passwordError = true;
    $('#password').keyup(function() {
        validatePassword();
    });

    function validatePassword() {   
        // Валидация пароля
        if (!$password.val()) {
            passwordError = false;
            $('#password-error').text('Введите пароль').show();
            $password.css('border-color', 'red');
        } else if ($password.val().length < 6) {
            passwordError = false;
            $('#password-error').text('Пароль должен содержать минимум 6 символов').show();
            $password.css('border-color', 'red');
        } else {
            passwordError = true;
            $('#password-error').hide();
            $password.css('border-color', '');
        }
    }

    // Сброс стилей при вводе
    $login.on('input', function() {
        $(this).css('border-color', '');
    });

    $password.on('input', function() {
        $(this).css('border-color', '');
    });

    $('#submit-button').click(function() {
        validateUsername();
        validatePassword();
        if (usernameError && passwordError) {
            console.log('Форма валидна');
            return true;
        } else {
            alert('Проверьте правильность введенных данных');
            return false;
        }
    });
});

