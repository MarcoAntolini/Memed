<section class="notification-container di-flex p-2 card"">
    <div class="row">
	<form action="#" method="post">
		<div>
			<p class="fw-bold">Hai <?php echo $templateParams["notificationsNumber"]; ?> notifiche non lette</p>
			<button id="readall" class="btn btn-success" type="submit" name="readAll">Leggi tutto</button>
			<button id="clearall" class="btn btn-danger" type="submit" name="deleteAll">Cancella tutto</button>
			<input type="hidden" id="notifications-number" value="<?php echo $templateParams["notificationsNumber"]; ?>">
			<input type="hidden" id="notification-Id" value="<?php echo $templateParams["notifications"]; ?>">
		</div>
	</form>
	<?php if (isset($templateParams["js"])) : ?>
		<div id="notification-section"></div>
	<?php endif ?>
	</div>
</section>