function validatePhoneNumber(input) {
    var phoneNumber = input.value.replace(/\D/g, '');
    input.value = phoneNumber.slice(0, 10);
}