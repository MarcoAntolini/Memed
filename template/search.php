<div class="search-container">
	<?php if (empty($usersList)) : ?>
		<h2 class="text-center">Nessun risultato</h2>
	<?php else : ?>
		<?php foreach ($usersList as $user) : ?>
			<?php if ($user["Username"] !== $_SESSION["loggedUser"]) : ?>
				<div class="card p-2">
					<div class="">
						<img src="<?php echo UPLOAD_DIR . $user["FileName"] ?>" alt="profile-picture" class="profile-pic" />
						<div class="">
							<h2 class="fw-bold">
								<a href="user.php?username=<?php echo $user["Username"] ?>">
									@<?php echo $user["Username"] ?>
								</a>
								<br>
							</h2>
							<p class="text-muted"><?php echo $user["Bio"] ?></p>
						</div>
					</div>
					<?php if ($mysqli->follows()->checkFollow($user["Username"])) : ?>
						<form action="#" method="post">
							<input type="hidden" name="unfollowing" value="<?php echo $user["Username"] ?>">
							<button type="submit" class="btn btn-primary">Smetti di seguire</button>
						</form>
					<?php else : ?>
						<form action="#" method="post">
							<input type="hidden" name="following" value="<?php echo $user["Username"] ?>">
							<button type="submit" class="btn btn-primary">Segui</button>
						</form>
					<?php endif; ?>
				</div>
	<?php
			endif;
		endforeach;
	endif;
	?>
</div>