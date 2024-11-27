let UserNameOfSystem = Array.from({ length: 1000 }, () => Array(2).fill(""));
var elements = document.getElementsByClassName("wrapper");
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "flex";
    }
function check_name() {
    let username = document.getElementById("input_username").value;
    for (let i = 0; i < UserNameOfSystem.length; i++) {
        if (username === UserNameOfSystem[i][0] || username === "") {
            return false;
        }
    }
    return true;
    }
function a() {
    let password = document.getElementById("input_password").value;
    if (password.length > 8) {
        var keyword = ["@", "#", "$", "%", "^", "&", "*", "~", "`"];
        for (i = 0; i < keyword.length; i++) {
            if (password.indexOf(keyword[i]) !== -1) {
                return true;
            }
        }
    }
    return false;
}
function b() {
    let password = document.getElementById("input_password").value;
    let password1 = document.getElementById("input_password1").value;
    if (password === password1 && password1 !== "") {
        return true;
    }
    return false;
}
function ha() {
    let password = document.getElementById("input_password").value;
    let password1 = document.getElementById("input_password1").value;
    if (check_name() === false) {
        document.getElementById("pass_username").innerHTML = "&#215;";
        document.getElementById("pass_username").style.color = "red";
    }
    else {
        document.getElementById("pass_username").innerHTML = "&radic;";
        document.getElementById("pass_username").style.color = "green";
    }
    if (a() === true) {
        document.getElementById("check_pass").innerHTML = "&radic;";
        document.getElementById("check_pass").style.color = "green";
    }
    else {
        document.getElementById("check_pass").innerHTML = "&#215;";
        document.getElementById("check_pass").style.color = "red";
    }
    if (b() === true && password === password1) {
        document.getElementById("check_pass1").innerHTML = "&radic;";
        document.getElementById("check_pass1").style.color = "green";
    }
    else {
        document.getElementById("check_pass1").innerHTML = "&#215;";
        document.getElementById("check_pass1").style.color = "red";
    }
}
function register1() {
    let username = document.getElementById("username").value;
    let password = document.getElementById('input_password').value;
    let password1 = document.getElementById('input_password1').value;
    if (check_name() && a() && b() && password === password1) {
        
        document.getElementById('demo').innerHTML = 'true';
    }
}
setInterval(function () {
    ha();
}, 0);