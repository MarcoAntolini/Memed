<!--TODO: action va completato con il file php che elaborerà i dati-->
<form action="" class="registration-form" method="post">
    <div class="email">
        <input id="email-input" required="true" type="text" name="email" placeholder="Email" maxlength="30" />
    </div>
    <div class="username">
        <input id="username-input" required="true" type="text" name="username" placeholder="Username" maxlength="30" />
    </div>
    <div class="password">
        <input id="password-input-register" required="true" type="password" name="password" placeholder="Password" />
        <button id="show-pw-btn-register" class="show-pw-btn" type="button">Mostra</button>
    </div>
    <div class="confirm-password">
        <input id="password-input-confirm" required="true" type="password" name="confirm-password" placeholder="Conferma password" />
        <button id="show-pw-btn-confirm" class="show-pw-btn" type="button">Mostra</button>
    </div>
    <button id="registration-button" class="btn btn-primary" type="submit" disabled>Iscriviti
    </button>
    <div class="login-redirect">
        <p>Hai già un account?
            <a href="../template/login.php" role="link">
                <span class="redirect">Accedi</span>
            </a>
        </p>
    </div>
</form>