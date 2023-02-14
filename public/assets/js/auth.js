window.onload = function () {
    const showButtons = document.querySelectorAll(".show-pw-btn");
    showButtons.forEach(button => {
        button.addEventListener("click", function () {
            showPassword(button);
        });
    });

    const passwordLogin = document.getElementById("password-input-login");
    const passwordRegister = document.getElementById("password-input-register");
    const passwordConfirm = document.getElementById("password-input-confirm");
    const emailInput = document.getElementById("email-input");
    const usernameInput = document.getElementById("username-input");
    const registerButton = document.getElementById("register-button");
    const loginButton = document.getElementById("login-button");
    if (emailInput && usernameInput && passwordRegister && passwordConfirm && registerButton) {
        emailInput.addEventListener("keyup", function () {
            checkRegisterButton(emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton);
        });
        usernameInput.addEventListener("keyup", function () {
            checkRegisterButton(emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton);
        });
        passwordRegister.addEventListener("keyup", function () {
            checkRegisterButton(emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton);
        });
        passwordConfirm.addEventListener("keyup", function () {
            checkRegisterButton(emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton);
        });
    } else if (emailInput && passwordLogin && loginButton) {
        emailInput.addEventListener("keyup", function () {
            checkLoginButton(emailInput, passwordLogin, loginButton);
        });
        passwordLogin.addEventListener("keyup", function () {
            checkLoginButton(emailInput, passwordLogin, loginButton);
        });
    }
};

function showPassword(button) {
    const buttonId = button.id;
    let passwordInput;
    switch (buttonId) {
        case "show-pw-btn-login":
            passwordInput = document.getElementById("password-input-login");
            break;
        case "show-pw-btn-register":
            passwordInput = document.getElementById("password-input-register");
            break;
        case "show-pw-btn-confirm":
            passwordInput = document.getElementById("password-input-confirm");
            break;
        default:
            break;
    }
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    button.innerText = button.innerText === "Mostra" ? "Nascondi" : "Mostra";
}

function checkRegisterButton(emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton) {
    if (validateEmail(emailInput) && validateUsername(usernameInput)
        && validatePassword(passwordRegister) && validatePassword(passwordConfirm)
        && comparePasswords(passwordRegister, passwordConfirm)) {
        registerButton.disabled = false;
    } else {
        registerButton.disabled = true;
    }
}

function checkLoginButton(emailInput, passwordLogin, loginButton) {
    if (validateEmail(emailInput) && validatePassword(passwordLogin)) {
        loginButton.disabled = false;
    } else {
        loginButton.disabled = true;
    }
}

function comparePasswords(pwInput1, pwInput2) {
    if (pwInput1.value === pwInput2.value) {
        return true;
    }
    return false;
}

function validatePassword(passwordInput) {
    /*const validRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-!"#$%&'()*+,.\/:;<=>?@[\\\]^_`{|}~])[A-Za-z\d!"#$%&'()*+,.\/:;<=>?@[\\\]^_`{|}~-]{8,}$/;
    if (passwordInput.value.match(validRegex) && passwordInput.value !== "") {
        return true;
    }
    return false;*/
    return true;
}

function validateUsername(usernameInput) {
    const validRegex = /^[a-zA-Z0-9]+$/;
    if (usernameInput.value.match(validRegex) && usernameInput.value !== "") {
        return true;
    }
    return false;
}

function validateEmail(emailInput) {
    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*$/;
    if (emailInput.value.match(validRegex) && emailInput.value !== "") {
        return true;
    }
    return false;
}