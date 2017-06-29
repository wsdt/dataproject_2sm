/**
 * Created by kevin on 29.06.2017.
 */

function pruefeLoginRegisterAccurate() {
    var hiddenfield = document.getElementById('login_or_register').value;
    var label = document.getElementById('register_login_convert_label').innerHTML;
    if (label === "<strong>Already have an account? Login <a onclick='convertLoginRegisterForm()'>here</a>.</strong>") {
        hiddenfield = "register";
    } else if (label === "<strong>No account? Register <a onclick='convertLoginRegisterForm()'>here</a>.</strong>") {
        hiddenfield = "login";
    }
}

function convertLoginRegisterForm() {
    var pwd_repeat = document.getElementById('password_repeat');
    var label = document.getElementById('register_login_convert_label');
    var hiddenfield = document.getElementById('login_or_register');
    if (pwd_repeat.style.display === "none") {
        //Change Message and show 2nd password field for registration and change hidden form field that php knows what to do
        label.innerHTML = "<strong>Already have an account? Login <a onclick='convertLoginRegisterForm()'>here</a>.</strong>";
        pwd_repeat.style.display = "inline-block"; //show field
        hiddenfield.value = "register";
    } else {
        label.innerHTML = "<strong>No account? Register <a onclick='convertLoginRegisterForm()'>here</a>.</strong>";
        pwd_repeat.style.display = "none"; //hide field
        hiddenfield.value = "login"; //saying that you want to log in
    }
}

function validateLoginRegisterForm() {
    var hiddenfield = document.getElementById('login_or_register').value;
    var pwd = document.getElementById('password').value;
    var pwd_repeat = document.getElementById('password_repeat').value;
    var username = document.getElementById('username').value;

    if (hiddenfield === "register") {
        if (pwd === pwd_repeat && pwd.length >= 4 && username.length >= 4) {
            return true;
        }
    } else if (hiddenfield === "login") {
        if (pwd !== "" && username !== "") {
            return true;
        }
    }
    alert("Bitte überprüfen Sie Ihre Eingabedaten!");
    return false;
}