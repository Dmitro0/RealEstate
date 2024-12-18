$(document).ready(function() {
    function updateCount() {
        const formData = {
            type_object: $('#type-object').val() !== 'placeholder' ? $('#type-object').val() : null,
            rooms: $('#rooms').val() !== 'placeholder' ? $('#rooms').val() : null,
            price_from: $('input[placeholder="Цена от"]').val() || null,
            price_to: $('input[placeholder="Цена до"]').val() || null,
            renovation: $('#otdelka').val() !== 'placeholder' ? $('#otdelka').val() : null,
            area_from: $('input[placeholder="Площадь от"]').val() || null,
            area_to: $('input[placeholder="Площадь до"]').val() || null
        };

        Object.keys(formData).forEach(key => {
            if (formData[key] === null) {
                delete formData[key];
            }
        });

        $.ajax({
            url: 'src/filter_realty.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                console.log(data);
                if (data.count !== undefined) {
                    $('.result-count').text(data.count);
                }
            },
            error: function() {
                console.error('Ошибка при обновлении количества результатов');
            }
        });
    }
    $('.select-list, .price-input, .area-input').on('change input', function() {
        updateCount();
    });

    $('.show-button').click(function(e) {
        e.preventDefault();
        
        let url = 'properties.php?';
        const params = [];
        
        if ($('#type-object').val() !== 'placeholder') {
            params.push('type=' + $('#type-object').val());
        }
        if ($('#rooms').val() !== 'placeholder') {
            params.push('rooms=' + $('#rooms').val());
        }
        if ($('input[placeholder="Цена от"]').val()) {
            params.push('price_from=' + $('input[placeholder="Цена от"]').val());
        }
        if ($('input[placeholder="Цена до"]').val()) {
            params.push('price_to=' + $('input[placeholder="Цена до"]').val());
        }
        if ($('#otdelka').val() !== 'placeholder') {
            params.push('renovation=' + $('#otdelka').val());
        }

        if ($('input[placeholder="Площадь от"]').val()) {
            params.push('area_from=' + $('input[placeholder="Площадь от"]').val());
        }
        if ($('input[placeholder="Площадь до"]').val()) {
            params.push('area_to=' + $('input[placeholder="Площадь до"]').val());
        }

        if (params.length > 0) {
            url += params.join('&');
        }

        window.location.href = url;
    });

    $('.reset-button').click(function() {
        $('.select-list').val('placeholder');
        $('.price-input, .area-input').val('');
        updateCount();
    });
}); 