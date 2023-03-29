<section class="notice-container di-flex p-2 card"">
    <div class=" row">
	<form action="#" method="post">
		<div>
			<p class="fw-bold">Hai <?php echo $templateParams["notificationsNumber"]; ?> notifiche non lette</p>
			<button id="readall" class="btn btn-success" type="submit" name="leggi-tutto">Leggi tutto</button>
			<button id="clearall" class="btn btn-danger" type="submit" name="cancella-tutto">Cancella tutto</button>
			<input type="hidden" id="notifications-number" value="<?php echo $templateParams["notificationsNumber"]; ?>">
			<input type="hidden" id="notification-Id" value="<?php echo $templateParams["notifications"]; ?>">
		</div>
	</form>
	<?php if (isset($templateParams["js"])) : ?>
		<div id="notice-section"></div>
	<?php endif ?>
	</div>
</section>