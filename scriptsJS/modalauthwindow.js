
function toggleAuthModal() {
    const authModal = document.getElementById('authModal');
    const body = document.getElementById('main-body');
    const header = document.getElementById('header');
    if (authModal.style.zIndex == 9999) {
        authModal.style.zIndex = -1;
        body.classList.remove('body--blur');
    } else {
        authModal.style.zIndex = 9999;
        body.classList.add('body--blur');
    }
}

