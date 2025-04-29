function validatePasswords(){
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    if(password !== confirmPassword) {
        alert("A két jelszó nem egyezik meg.");
        return false;
    }
    return true;

}

export default validatePasswords;
