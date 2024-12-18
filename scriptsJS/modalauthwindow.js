
function toggleAuthModal() {
    const authModal = document.getElementById('authModal');

    if (authModal.style.zIndex == 9999) {
        authModal.style.zIndex = -1;

    } else {
        authModal.style.zIndex = 9999;

    }
}

