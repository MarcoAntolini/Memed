<header class="header container-fluid d-flex justify-content-center color-main p-2 fixed-top top-0">
	<div class="col mobile-hidden tablet-hidden">
		<a class="btn" data-bs-toggle="offcanvas" href="#notificationsOffcanvas" role="button" aria-controls="notificationsOffcanvas">
			<span class="counter position-absolute badge rounded-pill bg-danger" id="unread-badge-counter">
				<span class="visually-hidden">Notifiche non lette</span>
			</span>
			<img src="../public/assets/img/notifications.png" alt="notifications" class="notifications-icon">
		</a>
	</div>
	<div class="col">
		<form id="search-form" action="../modules/search.php" method="GET" class="m-0">
			<div class="input-group">
				<div class="form-floating form-group">
					<input class="form-control" name="search" list="recents" id="search" placeholder="Cerca">
					<label for="search" class="form-label">Cerca</label>
				</div>
				<button id="search-button" type="submit" class="btn btn-primary">
					<img src="../public/assets/img/search.png" alt="search" class="search-icon">
				</button>
			</div>
		</form>
	</div>
	<div class="col">
		<a href="settings.php" class="float-end btn">
			<img src="../public/assets/img/settings.png" alt="settings" class="settings-icon">
		</a>
	</div>
</header>

<div class="offcanvas offcanvas-start" tabindex="-1" id="notificationsOffcanvas" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-header">
		<form action="#" method="post">
			<div>
				<p class="fw-bold">Hai <span id="unread-notification-number"></span> notifiche non lette</p>
				<button id="readall" class="btn btn-success" type="submit" name="readAll">Leggi tutto</button>
				<button id="clearall" class="btn btn-danger" type="submit" name="deleteAll">Cancella tutto</button>
			</div>
		</form>
	</div>
	<div class="offcanvas-body notification-container di-flex p-2 card">
		<div class="row">
			<?php if (isset($templateParams["js"])) : ?>
				<div id="notification-section"></div>
			<?php endif ?>
		</div>
	</div>
</div>