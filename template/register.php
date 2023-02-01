<header class="registration-header">Iscriviti!</header>
<div id="splash-screen">
    <div class="logo">Memed</div>
    <div class="form">
        <form action="" class="registration-form" method="post">
            <!--TODO: action va completato con il file php che elaborerà i dati-->
            <div class="email">
                <input id="email-input" required="true" type="text" name="email" placeholder="Email o username" />
                <!--TODO: aggiungere il campo maxlength nell'input una volta deciso 
                            il numero di caratteri max per l'username nel DB
                        -->
            </div>
            <div class="password">
                <input id="password-input" required="true" type="password" name="password" placeholder="Password" />
                <button id="show-pw-btn" type="button" onclick="showPassword()">Mostra</button>
                <!-- <script>
                function showPassword() {
                    const x = document.getElementById("password-input");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                    const btn = document.getElementById("show-pw-btn");
                    if (btn.innerText === "Mostra") {
                        btn.innerText = "Nascondi";
                    } else {
                        btn.innerText = "Mostra";
                    }
                }
                </script> -->
                <!--TODO: showPassword è da trasferire in un file JS-->
            </div>
            <div class="confirm-password">
                <input id="confirm-password-input" required="true" type="password" name="confirm-password" placeholder="Conferma password" />
                <button id="show-cpw-btn" type="button">Mostra</button>
                <!-- <script>
                function showConfirmPassword() {
                    const x = document.getElementById("confirm-password-input");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                    const btn = document.getElementById("show-cpw-btn");
                    if (btn.innerText === "Mostra") {
                        btn.innerText = "Nascondi";
                    } else {
                        btn.innerText = "Mostra";
                    }
                }
                </script> -->
                <!--TODO: showConfirmPassword è da trasferire in un file JS e ancora meglio unirlo a showPassword per evitare ripetizione di codice-->
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
                    <a href="login.html" role="link">
                        <span class="redirect">Accedi</span>
                    </a>
                </p>
            </div>
        </form>
    </div>
    <div id="footer">
        <span>© 2023 Memed. Tutti i diritti riservati.</span>
    </div>
</div>