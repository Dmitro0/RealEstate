$(document).ready(function() {
    const $name = $('#name');
    const $phone = $('#phone');
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

    $('#view-submit-btn').click(function() {
        validateName($name);
        validatePhone($phone);

        if (nameError && phoneError) {
            $.ajax({
                url: 'src/view_request.php',
                type: 'POST',
                data: {
                    name: $name.val(),
                    phone: $phone.val(),
                    realty: $('#realty').val(),
                    customer: $('#customer').val()
                },
                success: function(response) {
                    console.log(response);
                    if (response.trim() === "success") {
                        alert('Заявка успешно отправлена!');
                        viewModal();
                        $name.val('');
                        $phone.val('');
                    } else if (response.trim() === "auth_required") {
                        alert("Для отправки заявки необходимо авторизоваться");
                        viewModal();
                        toggleAuthModal();
                    } else {
                        alert('Произошла ошибка при отправке заявки');
                        console.log(response);
                    }
                },
                error: function() {
                    alert('Произошла ошибка при отправке заявки');
                }
            });
            return true;
        } else {
            alert('Проверьте правильность введенных данных');
            return false;
        }
    });
});
