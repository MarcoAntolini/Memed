<div class="my-profile">
	<div class="user-data-section">
		<img class="profile-pic" src="<?php echo UPLOAD_DIR . $templateParams["profile"]["FileName"]; ?>" alt="profile-pic">
		<div class="user">
			<h2 class="username">
				<?php echo $templateParams["profile"]["Username"]; ?>
			</h2>
			<?php
			switch ($templateParams["averageReaction"]) {
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

		<p class="bio">
			<?php echo $templateParams["profile"]["Bio"]; ?>
		</p>
		<div class="follow-buttons">
			<button class="follower-count btn btn-info" type="button" data-bs-toggle="modal" data-bs-target=".follower-list">
				Follower: <?php echo $templateParams["followersNumber"]; ?>
			</button>
			<button class="followed-count btn btn-info" type="button" data-bs-toggle="modal" data-bs-target=".followed-list">
				Seguiti: <?php echo $templateParams["followedNumber"]; ?>
			</button>
			<?php if ($templateParams["username"] != $_SESSION["loggedUser"]) : ?>
				<div class="follow-section">
					<?php if ($templateParams["isFollowing"]) : ?>
						<form action="#" method="post">
							<input type="hidden" name="unfollowing" value="<?php echo $templateParams["username"]; ?>">
							<button type="submit" class="btn btn-primary">Smetti di seguire</button>
						</form>
					<?php else : ?>
						<form action="#" method="post">
							<input type="hidden" name="following" value="<?php echo $templateParams["username"]; ?>">
							<button type="submit" class="btn btn-primary">Segui</button>
						</form>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="follower-list modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
			<div id="follower-list" class="modal-dialog modal-dialog-scrollable modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Follower</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<?php if ($templateParams["followerList"] != null) : ?>
							<?php foreach ($templateParams["followerList"] as $follower) : ?>
								<div class="follower mb-3">
									<img src="<?php echo UPLOAD_DIR . $mysqli->users()->getFileNameByUsername($follower["FollowerUsername"]); ?>" alt="follower-profile-pic">
									<a href="user.php?username=<?php echo $follower["FollowerUsername"]; ?>" class="fw-bold">
										@<?php echo $follower["FollowerUsername"]; ?>
									</a>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="followed-list modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
			<div id="followed-list" class="modal-dialog modal-dialog-scrollable modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Seguiti</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<?php if ($templateParams["followedList"] != null) : ?>
							<?php foreach ($templateParams["followedList"] as $followed) : ?>
								<div class="followed mb-3">
									<img src="<?php echo UPLOAD_DIR . $mysqli->users()->getFileNameByUsername($followed["FollowedUsername"]); ?>" alt="followed-profile-pic">
									<a href="user.php?username=<?php echo $followed["FollowedUsername"]; ?>" class="fw-bold">
										@<?php echo $followed["FollowedUsername"]; ?>
									</a>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if (isset($templateParams["js"])) : ?>
		<div id="post-section"></div>
	<?php endif ?>
</div>