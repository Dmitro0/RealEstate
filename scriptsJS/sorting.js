function applySorting(sortOrder) {
    if (!sortOrder) return;
    
    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('sort', sortOrder);
    
    window.location.href = currentUrl.toString();
}

// Установка выбранного значения в селекте при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const sortValue = urlParams.get('sort');
    if (sortValue) {
        document.getElementById('price-sort').value = sortValue;
    }
}); 