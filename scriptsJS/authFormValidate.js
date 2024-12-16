$(document).ready(function() {
    const $login = $('#login');
    const $password = $('#password');

    $('#login-error').hide();
    $('#password-error').hide();
    let usernameError = true;
    $('#login').keyup(function() {
        validateUsername($login, '#login-error');
    });

    function validateUsername(username, errorField) {
        if (!username.val().trim()) {
            usernameError = false;
            $(errorField).text('Введите логин').show();
            username.css('border-color', 'red');
        } else if (username.val().length < 4) {
            usernameError = false;
            $(errorField).text('Логин должен содержать минимум 4 символа').show();
            username.css('border-color', 'red');
        } else {
            usernameError = true;
            $(errorField).hide();
            username.css('border-color', '');
        }
    }

    let passwordError = true;
    $('#password').keyup(function() {
        validatePassword($password);
    });

    function validatePassword(passwd) {   

        if (!passwd.val()) {
            passwordError = false;
            $('#password-error').text('Введите пароль').show();
            passwd.css('border-color', 'red');
        } else if (passwd.val().length < 6) {
            passwordError = false;
            $('#password-error').text('Пароль должен содержать минимум 6 символов').show();
            passwd.css('border-color', 'red');
        } else {
            passwordError = true;
            $('#password-error').hide();
            passwd.css('border-color', '');
        }
    }

    $login.on('input', function() {
        $(this).css('border-color', '');
    });
    $password.on('input', function() {
        $(this).css('border-color', '');
    });

    $('#submit-button').click(function() {
        console.log($login);
        validateUsername($login, '#login-error');
        validatePassword($password);
        if (usernameError && passwordError) {
            console.log($login.val());
            console.log($password.val());
            console.log('Форма валидна');
            $.ajax({
                url: 'src/login.php',
                type: 'POST',
                data: {
                    login: $login.val(),
                    password: $password.val()
                },
                
                success: function(response) {
                    if (response.trim() === "success") {
                        window.location.reload();
                        const userTextElement = document.getElementById('user-text');
                        userTextElement.textContent = $login.val();

                    } else {
                        $('#auth-error').removeClass('display-none');
                        $login.css('border-color', 'red');
                        $password.css('border-color', 'red');
                    }
                },
                error: function() {
                    $('#auth-error').removeClass('display-none');
                }
            });
            return true;
        } else {
            alert('Проверьте правильность введенных данных');
            return false;
        }
    });
});

