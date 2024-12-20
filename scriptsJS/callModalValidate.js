$(document).ready(function() {
    const $name = $('#call-name');
    const $phone = $('#call-phone');
    let nameError = false;
    let phoneError = false;

    function validateName($field) {
        if (!$field.val()) {
            nameError = false;
            $field.css('border-color', 'red');
            return;
        }
        
        if ($field.val().length < 2) {
            nameError = false; 
            $field.css('border-color', 'red');
            return;
        }

        nameError = true;
        $field.css('border-color', '');
    }

    function validatePhone($field) {
        const phoneRegex = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
        
        if (!$field.val()) {
            phoneError = false;
            $field.css('border-color', 'red');
            return;
        }

        if (!phoneRegex.test($field.val())) {
            phoneError = false;
            $field.css('border-color', 'red');
            return;
        }

        phoneError = true;
        $field.css('border-color', '');
    }

    $name.on('blur', function() {
        validateName($name);
    });

    $phone.on('blur', function() {
        validatePhone($phone);
    });

    $name.on('input', function() {
        $(this).css('border-color', '');
    });

    $phone.on('input', function() {
        $(this).css('border-color', '');
    });

    $('#call-submit-btn').click(function() {
        validateName($name);
        validatePhone($phone);

        if (nameError && phoneError) {
            alert("Заявка успешно оставлена!");
            callbackModal();
        }
        else{
            alert("Проверьте введенные данные!");
        }
    })
    }
);
