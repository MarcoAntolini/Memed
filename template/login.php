<form action="#" method="post">
	<div class="error mb-3">
		<?php if (isset($templateParams["loginErrorMessage"])) : ?>
			<p id="error-message">
				<?php echo $templateParams["loginErrorMessage"] ?>
			</p>
		<?php endif ?>
	</div>
	<div class="email input-group mb-3">
		<input id="email-input" type="email" name="email" placeholder="Email" maxlength="30" class="form-control" required />
	</div>
	<div class="password input-group mb-3">
		<input id="password-input-login" type="password" name="password" placeholder="Password" class="form-control" required />
		<button id="show-pw-btn-login" type="button" class="show-pw-btn btn btn-primary">Mostra</button>
	</div>
	<button id="login-button" type="submit" class="btn btn-primary float-end mb-3">Accedi</button>
</form>
<div class="register-redirect mb-3">
	<p class="fst-italic small">Non hai un account?
		<a href="../modules/register.php">
			<span class="redirect">Iscriviti</span>
		</a>
	</p>
</div>