<script type="text/javascript" src="../public/assets/js/sha512.js"></script>
<script type="text/javascript" src="../public/assets/js/forms.js"></script>

<?php if (isset($templateParams["errorelogin"])) : ?>
    <p><?php echo $templateParams["errorelogin"]; ?></p>
<?php endif; ?>
<form action="#" method="post">
    <div class="email">
        <input id="email-input" required="true" type="text" name="email" placeholder="Email" maxlength="30" />
    </div>
    <div class="password">
        <input id="password-input-login" required="true" type="password" name="password" placeholder="Password" />
        <button id="show-pw-btn-login" class="show-pw-btn btn btn-primary" type="button">Mostra</button>
    </div>
    <button id="login-button" class="btn btn-primary" type="submit" disabled>Accedi</button>
    <div class="register-redirect">
        <p>Non hai un account?
            <a href="../modules/register.php" role="link">
                <span class="redirect">Iscriviti</span>
            </a>
        </p>
    </div>
</form>