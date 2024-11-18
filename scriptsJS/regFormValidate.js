$(document).ready(function() {
    

    const $registration_login = $('#reg-login');
    const $registration_password =  $('#reg-password');
    const $repeated_password = $('#repeat-password');


    $('#reg-login-error').hide();
    $('#reg-password-error').hide();
    $('#reg-repeat-password-error').hide();


    let usernameError = true;
    $('#reg-login').keyup(function(){
        validateUsername($registration_login, '#reg-login-error');
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

    let registrationPasswdError = true;
    $('#reg-password').keyup(function(){
        validateRegistrationPassword($registration_password);
    });
    
    function validateRegistrationPassword(passwd){

        if (!passwd.val()) {
            passwordError = false;
            $('#reg-password-error').text('Введите пароль').show();
            passwd.css('border-color', 'red');
        } else if (passwd.val().length < 6) {
            passwordError = false;
            $('#reg-password-error').text('Пароль должен содержать минимум 6 символов').show();
            passwd.css('border-color', 'red');
        } else if(!/\d/.test(passwd.val())){
            passwordError = false;
            $('#reg-password-error').text('Пароль должен содержать цифры').show();
            passwd.css('border-color', 'red');
        } else if(!/[A-Z]/.test(passwd.val())){
            passwordError = false;
            $('#reg-password-error').text('Пароль должен содержать заглавные буквы').show();
            passwd.css('border-color', 'red');
        } else if(!/[!@#$%^&*]/.test(passwd.val())){
            passwordError = false;
            $('#reg-password-error').text('Пароль должен содержать спец символы (!@#$%^&*)').show();
            passwd.css('border-color', 'red');
        } else{
            passwordError = true;
            $('#reg-password-error').hide();
            passwd.css('border-color', '');
        }
    }

    let repeatPasswordError = true;
    $('#repeat-password').keyup(function(){
        validateRepeatPassword($registration_password, $repeated_password);
    });

    function validateRepeatPassword(passwd, repeat){
        if(passwd.val() != repeat.val() && passwd.val().trim()){
            repeatPasswordError = false;
            $('#reg-repeat-password-error').text('Пароли должны совпадать').show();
            repeat.css('border-color', 'red');
        }else if(!passwd.val().trim()){
            repeatPasswordError = false;
            $('#reg-repeat-password-error').text('Для начала введите пароль').show();
            repeat.css('border-color', 'red');
        }
        else{
            repeatPasswordError = true;
            $('#reg-repeat-password-error').hide();
            repeat.css('border-color', '');
        }
    }

    $registration_login.on('input', function() {
        $(this).css('border-color', '');
    });

    $registration_password.on('input', function() {
        $(this).css('border-color', '');
    });

    $repeated_password.on('input', function() {
        $(this).css('border-color', '');
    });

    $('#registration-button').click(function(){
        validateUsername($registration_login, '#reg-login-error');
        validateRegistrationPassword($registration_password);
        validateRepeatPassword($registration_password, $repeated_password);

        if(usernameError && registrationPasswdError && repeatPasswordError){
            console.log('Регистрационная форма валидна');
        } else{
            alert('Проверьте правильность введенных данных');
            return false;
        }
    });
});