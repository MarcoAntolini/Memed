<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/x-icon" href="../public/assets/img/favicon.ico" />
	<link rel="stylesheet" href="../public/assets/css/style.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="../public/assets/js/auth.js"></script>
	<script src="../public/assets/js/redirect.js"></script>
	<title><?php echo $templateParams["title"]; ?></title>
</head>

<body>
	<header>
		<div class="container-fluid d-flex justify-content-center color-main p-2 fixed-top">
			<h1 class="title">Memed</h1>
		</div>
	</header>
	<main class="auth vw-100">
		<img src="../public/assets/img/logo.png" alt="logo" class="logo" />

		<?php
		if (isset($templateParams["page"])) {
			require $templateParams["page"];
		}
		?>
		<button type="button" class="btn btn-primary" id="toastButton" style="display:none">Show live toast</button>

		<div class="toast-container position-fixed bottom-0 end-0 p-3">
			<div id="registerSuccessToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
					<strong class="me-auto">Benvenuto!</strong>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body">
					Sei stato registrato con successo! Effettua il login per accedere al sito.
				</div>
			</div>
		</div>

	</main>
	<footer>
		<div class="container-fluid d-flex justify-content-center color-main p-2 fixed-bottom">
			<p>© 2023 Memed. Tutti i diritti riservati.</p>
		</div>
	</footer>
	<?php
	if ($templateParams["page"] == "../template/login.php") :
		if (isset($_SESSION["registrationSuccess"]) && $_SESSION["registrationSuccess"]) :
	?>
			<script>
				window.onload = () => {
					document.getElementById("toastButton").click()
				}
			</script>
	<?php
			unset($_SESSION["registrationSuccess"]);
		endif;
	endif;
	?>
</body>


</html>