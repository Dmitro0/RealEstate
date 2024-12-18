function bookingModal(realtyId) {
    const bookingModal = document.getElementById('bookingModal');
    if (bookingModal.style.zIndex == 9999) {
        bookingModal.style.zIndex = -1;
    } else {
        bookingModal.style.zIndex = 9999;
        if (realtyId) {
            document.getElementById('realty-id').value = realtyId;
        }
    }
}

function bookingCancel() {
    const bookingModal = document.getElementById('bookingModal');
    bookingModal.style.zIndex = -1;
}

function bookingSubmit() {
    const bookingModal = document.getElementById('bookingModal');
    bookingModal.style.zIndex = -1;

    $(document).ready(function() {
        const $user = $('#user');
        const $realtyId = $('#realty-id');

        const user = $user.val();
        const realtyId = $realtyId.val();
        console.log(user);
        $.ajax({
            url: 'src/bookingModal.php',
            type: 'POST',
            data: { 
                user: user, 
                'realty-id': realtyId
            },
            success: function(response) {
                console.log(response.trim());
                if (response.trim() == "success") {
                    alert("Недвижимость успешно забронирована");
                    bookingCancel();
                } else if (response.trim() == "auth_required") {
                    alert("Для бронирования недвижимости необходимо авторизоваться");
                    bookingCancel();
                    const authModal = document.getElementById('authModal');
                    if (authModal) {
                        authModal.style.zIndex = 9999;
                    }
                } else {
                    alert("Ошибка: " + response.trim());
                }
            }
        });
    });
}

