<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/assets/css/style.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title><?php echo $templateParams["titolo"]; ?></title>
</head>

<body>
    <div class="header container-fluid d-flex justify-content-center color-main p-2">
        <img src="" alt="logo" />
        <h1>Memed</h1>
    </div>
    <?php
    if (isset($templateParams["nome"])) {
        require $templateParams["nome"];
    }
    ?>
    <div class="footer container-fluid d-flex justify-content-center color-main p-2">
        © 2023 Memed. Tutti i diritti riservati.
    </div>
</body>

</html>