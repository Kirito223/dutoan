import loginApi from "../../api/loginApi.js";

var username, password, btnLogin, spinner;

window.onload = function() {
    initControl();
    initEvent();
};

function initControl() {
    username = document.getElementById("username");
    password = document.getElementById("password");
    btnLogin = document.getElementById("btnLogin");
    spinner = document.getElementsByClassName("spinner");
}

function initEvent() {
    btnLogin.onclick = function(e) {
        async function login() {
            spinner[0].classList.remove("hidden");
            let result = await loginApi.login({
                username: username.value,
                password: password.value
            });
            if (result.msg == "ok") {
                document;
                spinner[0].classList.add("hidden");
                window.location = "home";
            } else {
                spinner[0].classList.add("hidden");
                Swal.fire(result.data, result.data, "error");
            }
        }
        login();
    };
}
