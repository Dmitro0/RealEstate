function acceptModal(id) {
    const acceptModal = document.getElementById('acceptModal');
    if (acceptModal.style.zIndex == 9999) {
        acceptModal.style.zIndex = -1;
    } else {
        acceptModal.style.zIndex = 9999;
    }
    window.realtyId = id;
}

function accept() {
    removeBooking(window.realtyId);
    acceptModal();
}

function cancel() {
    acceptModal();
    return false;
}