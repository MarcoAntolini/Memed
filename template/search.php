<div class="search-container">
	<?php if (empty($usersList)) : ?>
		<h2 class="text-center">Nessun risultato</h2>
	<?php else : ?>
		<?php foreach ($usersList as $user) : ?>
			<?php if ($user["Username"] !== $_SESSION["loggedUser"]) : ?>
				<div class="card p-2">
					<div class="user-info">
						<img src="<?php echo UPLOAD_DIR . $user["FileName"] ?>" alt="profile-picture" class="profile-pic" />
						<div>
							<div class="user">
								<h2 class="fw-bold">
									<a href="user.php?username=<?php echo $user["Username"] ?>">
										@<?php echo $user["Username"] ?>
									</a>
									<br>
								</h2>
								<?php
								switch ($mysqli->users()->getAverageReactionByUsername($user["Username"])) {
									case 1:
										$reaction = "../public/assets/img/reaction-1.png";
										break;
									case 2:
										$reaction = "../public/assets/img/reaction-2.png";
										break;
									case 3:
										$reaction = "../public/assets/img/reaction-3.png";
										break;
									case 4:
										$reaction = "../public/assets/img/reaction-4.png";
										break;
									case 5:
										$reaction = "../public/assets/img/reaction-5.png";
										break;
									default:
										$reaction = "";
										break;
								}
								if ($reaction != "") : ?>
									<img src="<?php echo $reaction; ?>" alt="average reaction" class="average-reaction">
								<?php endif;
								?>
							</div>
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