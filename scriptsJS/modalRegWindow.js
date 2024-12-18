function toggleRegistrationModal(){
    const registrationModal = document.getElementById('registrationModal');
    const authModal = document.getElementById('authModal');

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
    authModal.style.zIndex = -1;
    registrationModal.style.zIndex = -1;
}