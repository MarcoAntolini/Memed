<form action="#" method="post">
    <div class="error mb-3">
        <p id="error-message">
            <?php if (isset($templateParams['erroreregistrazione'])) {
                echo $templateParams['erroreregistrazione'];
            } ?>
        </p>
    </div>
    <div class="email input-group mb-3">
        <input id="email-input" class="form-control" type="email" name="email" placeholder="Email" maxlength="30" required />
    </div>
    <div class="username input-group mb-3">
        <input id="username-input" class="form-control" type="text" name="username" placeholder="Username" maxlength="30" required />
    </div>
    <div class="password input-group mb-3">
        <input id="password-input-register" class="form-control" type="password" name="password" placeholder="Password" required />
        <button id="show-pw-btn-register" class="show-pw-btn btn btn-primary" type="button">Mostra</button>
    </div>
    <div class="confirm-password input-group mb-3">
        <input id="password-input-confirm" class="form-control" type="password" name="confirm-password" placeholder="Conferma password" required />
        <button id="show-pw-btn-confirm" class="show-pw-btn btn btn-primary" type="button">Mostra</button>
    </div>
    <button id="register-button" class="btn btn-primary float-end mb-3" type="submit" disabled>Iscriviti</button>
</form>
<div class="login-redirect mb-3">
    <p class="fst-italic small">Hai già un account?
        <a href="../modules/login.php">
            <span class="redirect">Accedi</span>
        </a>
    </p>
</div>