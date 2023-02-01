<script type="text/javascript" src="../public/assets/js/sha512.js"></script>
<script type="text/javascript" src="../public/assets/js/forms.js"></script>
<?php
if (isset($_GET['error'])) {
    echo 'Error Logging In!';
}
?>
<form action="process_login.php" method="post" name="login_form">
    <!--TODO: action va completato con il file php che elaborerà i dati-->
    <div class="email">
        <input id="email-input" required="true" type="text" name="email" placeholder="Email" />
        <!--TODO: aggiungere il campo maxlength nell'input una volta deciso 
                            il numero di caratteri max per l'username nel DB
                        -->
    </div>
    <div class="password">
        <input id="password-input" required="true" type="password" name="p" placeholder="Password" />
    </div>
    <div class="login-button">
        <button class="login-btn" type="submit">
            <a href="..\index.html" role="link">
                Accedi
            </a>
        </button>
        <!--TODO: Quando si ha il JS aggiungere l'attributo disabled al button per
                            rendere il btn attivabile/disattivabile a seconda del numero di caratteri
                        -->
        <!--TODO: Redirect a index.html se le credenziali sono corrette-->
        <!--TODO: Sostituire il tag <a> con il PHP ASAP-->
    </div>
    <div class="registration">
        <p>Non hai un account?
            <a href="registration.html" role="link">
                <span class="redirect">Iscriviti</span>
            </a>
        </p>
    </div>
    <!-- <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> -->
</form>