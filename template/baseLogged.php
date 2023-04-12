<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/x-icon" href="../public/assets/img/favicon.ico" />
	<link rel="stylesheet" href="../public/assets/css/style.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" integrity="sha512-cyzxRvewl+FOKTtpBzYjW6x6IAYUCZy3sGP40hn+DQkqeluGRCax7qztK2ImL64SA+C7kVWdLI6wvdlStawhyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" integrity="sha512-6lplKUSl86rUVprDIjiW8DuOniNX8UDoRATqZSds/7t6zCQZfaCe3e5zcGaQwxa8Kpn5RTM9Fvl3X2lLV4grPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<?php
	if (isset($templateParams["js"])) {
		foreach ($templateParams["js"] as $script) {
			echo '<script src="' . $script . '"></script>';
		}
	}
	switch ($templateParams["page"]) {
		case "newPost.php":
			echo '<script src="../public/assets/js/postPreview.js"></script>';
			break;
		case "settings.php":
			echo '<script src="../public/assets/js/settings.js"></script>';
			break;
		default:
			break;
	}
	?>
	<script src="../public/assets/js/search.js"></script>
	<script src="../public/assets/js/redirect.js"></script>
	<script src="../public/assets/js/notifications.js"></script>
	<title><?php echo $templateParams["title"]; ?></title>
</head>

<body>
	<?php require "components/header.php"; ?>
	<main>
		<?php
		if (isset($templateParams["page"])) {
			require $templateParams["page"];
		}
		?>
		<?php require_once "../modules/notification.php"; ?>
	</main>
	<?php require "components/footer.php"; ?>
</body>

</html>