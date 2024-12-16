
function toggleUserModal() {
    const userModal = document.getElementById('userModal');
    if (userModal.style.zIndex == 9999) {
        userModal.style.zIndex = -1;
    } else {
        userModal.style.zIndex = 9999;
    }
}