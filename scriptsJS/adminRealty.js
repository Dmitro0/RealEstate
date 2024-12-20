function makeEditable(element) {
    const editableElements = element.querySelectorAll('.realty-title, .realty-price, .area-value, .rooms-value, .floors-value, .plotarea-value, .address-value');
    editableElements.forEach(el => {
        el.contentEditable = true;
        el.classList.add('editing');
    });
}

function saveChanges(realtyId) {
    const container = document.querySelector(`[data-realty-id="${realtyId}"]`);
    
    const data = {
        id: realtyId,
        name: container.querySelector('.realty-title').textContent,
        costrealty: container.querySelector('.realty-price').textContent.replace(/[^\d.-]/g, ''),
        area: container.querySelector('.area-value').textContent.replace(/[^\d.-]/g, ''),
        rooms: container.querySelector('.rooms-value').textContent.replace(/[^\d.-]/g, ''),
        floors: container.querySelector('.floors-value').textContent.replace(/[^\d.-]/g, ''),
        plotarea: container.querySelector('.plotarea-value')?.textContent.replace(/[^\d.-]/g, ''),
        adress: container.querySelector('.address-value').textContent
    };

    $.ajax({
        url: 'src/edit_realty.php',
        type: 'POST',
        data: data,
        success: function(response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                alert('Изменения сохранены!');
                location.reload();
            } else {
                alert('Ошибка: ' + result.message);
            }
        },
        error: function() {
            alert('Произошла ошибка при сохранении');
        }
    });
}

function deleteRealty(realtyId) {
    if (!confirm('Вы уверены, что хотите удалить эту недвижимость?')) {
        return;
    }

    $.ajax({
        url: 'src/delete_realty.php',
        type: 'POST',
        data: { id: realtyId },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                alert('Недвижимость удалена');
                location.reload();
            } else {
                alert('Ошибка: ' + result.message);
            }
        },
        error: function() {
            alert('Произошла ошибка при удалении');
        }
    });
} 