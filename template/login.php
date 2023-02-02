<script type="text/javascript" src="../public/assets/js/sha512.js"></script>
<script type="text/javascript" src="../public/assets/js/forms.js"></script>

<?php
if (isset($_GET['error'])) {
    echo 'Error Logging In!';
}
?>

<?php if (isset($templateParams["erroreregistrazione"])) : ?>
<p><?php echo $templateParams["erroreregistrazione"]; ?></p>
<?php endif; ?>

<!--TODO: action va completato con il file php che elaborerà i dati-->
<form action="" method="post" name="login_form">
    <div class="email">
        <input id="email-input" required="true" type="text" name="email" placeholder="Email" maxlength="30" />
    </div>
    <div class="password">
        <input id="password-input-login" required="true" type="password" name="p" placeholder="Password" />
        <button id="show-pw-btn-login" class="show-pw-btn btn btn-primary" type="button">Mostra</button>
    </div>
    <button id="login-button" class="btn btn-primary" type="submit" disabled>Accedi</button>
    <!-- <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> -->
    <!--TODO: Quando si ha il JS aggiungere l'attributo disabled al button per
                            rendere il btn attivabile/disattivabile a seconda del numero di caratteri
                        -->
    <!--TODO: Sostituire il tag <a> con il PHP ASAP-->
    <div class="registration-redirect">
        <p>Non hai un account?
            <a href="../modules/registration.php" role="link">
                <span class="redirect">Iscriviti</span>
            </a>
        </p>
    </div>
</form>