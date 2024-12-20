function viewModal(realtyId) {

    const viewModal = document.getElementById('viewModal');
    if (viewModal.style.zIndex == 9999) {
        viewModal.style.zIndex = -1;
    } else {
        viewModal.style.zIndex = 9999;
        if (realtyId) {
            document.getElementById('realty').value = realtyId;
        }
    }
    return false;
}

function callbackModal(){
    console.log("Связаться");
    const callbackModal = document.getElementById('callback');
    if(callbackModal.style.zIndex == 9999){
        callbackModal.style.zIndex = -1;
    }
    else{
        callbackModal.style.zIndex = 9999;
    }
}