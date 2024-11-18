function toggleRegistrationModal(){
    const registrationModal = document.getElementById('registrationModal');
    const authModal = document.getElementById('authModal');
    const body = document.getElementById('main-body');
    const header = document.getElementById('header');
    if (authModal.style.zIndex == 9999) {
        authModal.style.zIndex = -1;
        registrationModal.style.zIndex = 9999;

    } else {
        authModal.style.zIndex = 9999;
        registrationModal.style.zIndex = -1;

    }
}
function closeRegistrationModal(){
    const registrationModal = document.getElementById('registrationModal');
    const authModal = document.getElementById('authModal');
    const body = document.getElementById('main-body');
    const header = document.getElementById('header');
    authModal.style.zIndex = -1;
    registrationModal.style.zIndex = -1;
    body.classList.remove('body--blur');
}