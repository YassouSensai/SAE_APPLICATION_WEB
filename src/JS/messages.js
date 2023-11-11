

setTimeout(function() {
    var errorMessage = document.getElementById('error-message');
    if (errorMessage) {
    errorMessage.style.display = 'none';
}

    var successMessage = document.getElementById('success');
    if (successMessage) {
    successMessage.style.display = 'none';
}
}, 3000);
