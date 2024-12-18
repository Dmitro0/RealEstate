function removeBooking(realtyId) {
    $.ajax({
        url: 'src/remove_booking.php',
        type: 'POST',
        data: { realty_id: realtyId },
        success: function(response) {
                if (response.trim() === "success") {
                    location.reload();
                } else {
                alert('Произошла ошибка при удалении бронирования');
            }
        }
    });
}

function removeView(realtyId) {
    if (confirm('Вы уверены, что хотите отменить просмотр?')) {
        $.ajax({
            url: 'src/remove_view.php',
            type: 'POST',
            data: { realty_id: realtyId },
            success: function(response) {
                if (response.trim() === "success") {
                    location.reload();
                } else {
                    alert('Произошла ошибка при отмене просмотра');
                }
            }
        });
    }
}

function toggleFavourite(realtyId, button) {
    $.ajax({
        url: 'src/toggle_favourite.php',
        type: 'POST',
        data: { realty_id: realtyId },
        success: function(response) {
            if (response.trim() === "added") {
                $(button).addClass('active');
            } else if (response.trim() === "removed") {
                $(button).removeClass('active');
            } else {
                alert('Неоходимо авторизоваться!');
                toggleAuthModal();
            }
        }
    });
} 

function removeFavourite(realtyId) {
    $.ajax({
        url: 'src/toggle_favourite.php',
        type: 'POST',
        data: { realty_id: realtyId },
        success: function(response) {
            if (response.trim() === "removed") {
                location.reload();
            } else {
                alert('Произошла ошибка при удалении из избранного');
            }
        }
    });
}
