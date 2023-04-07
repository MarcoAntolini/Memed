window.addEventListener("load", () => {
	const showButtons = document.querySelectorAll(".show-pw-btn")
	showButtons.forEach(button => button.addEventListener("click", () => showPassword(button)))

	const passwordLogin = document.getElementById("password-input-login")
	const passwordRegister = document.getElementById("password-input-register")
	const passwordConfirm = document.getElementById("password-input-confirm")
	const emailInput = document.getElementById("email-input")
	const usernameInput = document.getElementById("username-input")
	const registerButton = document.getElementById("register-button")
	const loginButton = document.getElementById("login-button")

	const registerForm = [emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton]
	const loginForm = [emailInput, passwordLogin, loginButton]

	if (registerForm.every(input => input !== null)) {
		registerForm.forEach(input => input.addEventListener("keyup", () => checkRegisterButton(...registerForm)))
	} else if (loginForm.every(input => input !== null)) {
		loginForm.forEach(input => input.addEventListener("keyup", () => checkLoginButton(...loginForm)))
	}

	const toastButton = document.getElementById("toastButton")
	const registerSuccessToast = document.getElementById("registerSuccessToast")
	if (toastButton) {
		toastButton.addEventListener("click", () => {
			const toast = new bootstrap.Toast(registerSuccessToast)
			toast.show()
		})
	}
})

function showPassword(button) {
	const buttonId = button.id
	let passwordInput
	switch (buttonId) {
		case "show-pw-btn-login":
			passwordInput = document.getElementById("password-input-login")
			break
		case "show-pw-btn-register":
			passwordInput = document.getElementById("password-input-register")
			break
		case "show-pw-btn-confirm":
			passwordInput = document.getElementById("password-input-confirm")
			break
		default:
			break
	}
	passwordInput.type = passwordInput.type === "password" ? "text" : "password"
	button.innerText = button.innerText === "Mostra" ? "Nascondi" : "Mostra"
}

function checkRegisterButton(emailInput, usernameInput, passwordRegister, passwordConfirm, registerButton) {
	registerButton.disabled = !(
		validateEmail(emailInput) &&
		validateUsername(usernameInput) &&
		validatePassword(passwordRegister) &&
		validatePassword(passwordConfirm) &&
		comparePasswords(passwordRegister, passwordConfirm)
	)
}

function checkLoginButton(emailInput, passwordLogin, loginButton) {
	loginButton.disabled = !(validateEmail(emailInput) && validatePassword(passwordLogin))
}

function comparePasswords(pwInput1, pwInput2) {
	return pwInput1.value === pwInput2.value
}

function validatePassword(passwordInput) {
	const validRegex =
		/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-!"#$%&'()*+,./:;<=>?@[\\\]^_`{|}~])[A-Za-z\d!"#$%&'()*+,./:;<=>?@[\\\]^_`{|}~-]{8,}$/
	return passwordInput.value.match(validRegex) && passwordInput.value !== ""
}

function validateUsername(usernameInput) {
	const validRegex = /^[a-zA-Z0-9]+$/
	return usernameInput.value.match(validRegex) && usernameInput.value !== ""
}

function validateEmail(emailInput) {
	const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*$/
	return emailInput.value.match(validRegex) && emailInput.value !== ""
}
