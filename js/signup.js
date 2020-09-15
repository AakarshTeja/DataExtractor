function password_check() {
    var pass = document.forms["signup_form"]["password"].value;
    var conf_pass = document.forms["signup_form"]["confirm_password"].value;
    //debugger;
    // alert(pass + " " + conf_pass);
    if (pass != conf_pass) {
        alert("Please enter confirm password same as password");
        return false;
    }
    return true;
}