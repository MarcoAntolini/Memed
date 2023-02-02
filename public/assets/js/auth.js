window.onload = function () {
    const showButtons = document.querySelectorAll(".show-pw-btn");
    showButtons.forEach(button => {
        button.addEventListener("click", function () {
            showPassword(button);
        });
    });

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

