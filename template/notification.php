<section class="notification-container di-flex p-2 card"">
    <div class=" row">
	<form action="#" method="post">
		<div>
			<p class="fw-bold">Hai <span id="unread-notification-number"></span> notifiche non lette</p>
			<button id="readall" class="btn btn-success" type="submit" name="readAll">Leggi tutto</button>
			<button id="clearall" class="btn btn-danger" type="submit" name="deleteAll">Cancella tutto</button>
		</div>
	</form>
	<?php if (isset($templateParams["js"])) : ?>
		<div id="notification-section"></div>
	<?php endif ?>
	</div>
</section>