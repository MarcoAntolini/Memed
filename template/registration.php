<form action="" class="registration-form" method="post">
    <!--TODO: action va completato con il file php che elaborerà i dati-->
    <div class="email">
        <input id="email-input" required="true" type="text" name="email" placeholder="Email" />
        <!--TODO: aggiungere il campo maxlength nell'input una volta deciso 
                    il numero di caratteri max per l'username nel DB
                -->
    </div>
    <div class="username">
        <input id="username-input" required="true" type="text" name="username" placeholder="Username" />
        <!--TODO: aggiungere il campo maxlength nell'input una volta deciso 
                    il numero di caratteri max per l'username nel DB
                -->
    </div>
    <div class="password">
        <input id="password-input-register" required="true" type="password" name="password" placeholder="Password" />
        <button id="show-pw-btn-register" class="show-pw-btn" type="button">Mostra</button>
    </div>
    <div class="confirm-password">
        <input id="password-input-confirm" required="true" type="password" name="confirm-password" placeholder="Conferma password" />
        <button id="show-pw-btn-confirm" class="show-pw-btn" type="button">Mostra</button>
    </div>
    <div class="registration-button">
        <button class="registration-btn" type="submit">Iscriviti</button>
        <!--TODO: Quando si ha il JS aggiungere l'attributo disabled al button per
                rendere il btn attivabile/disattivabile se le pw coincidono e se rispettano gli standard di sicurezza
            -->
        <!--TODO: Controllare se le credenziali della registrazioni sono valide al click, in tal caso redirect a login.html-->
    </div>
    <div class="login-redirect">
        <p>Hai già un account?
            <a href="../template/login.php" role="link">
                <span class="redirect">Accedi</span>
            </a>
        </p>
    </div>
</form>