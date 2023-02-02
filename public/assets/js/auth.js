window.onload = function () {
    const showButtons = document.querySelectorAll(".show-pw-btn");
    showButtons.forEach(button => {
        button.addEventListener("click", function () {
            showPassword(button);
        });
    });

    const pwInput1 = document.getElementById("password-input-register");
    const pwInput2 = document.getElementById("password-input-confirm");
    if (pwInput1 && pwInput2) {
        pwInput1.addEventListener("keyup", function () {
            checkPasswords(pwInput1, pwInput2);
        });
        pwInput2.addEventListener("keyup", function () {
            checkPasswords(pwInput1, pwInput2);
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

function checkPasswords(pwInput1, pwInput2) {
    const registerButton = document.getElementById("registration-button");
    // TODO: aggiungere controllo sicurezza?
    if (pwInput1.value == "" || pwInput2.value == "" || pwInput1.value !== pwInput2.value) {
        registerButton.disabled = true;
    } else {
        registerButton.disabled = false;
    }
}