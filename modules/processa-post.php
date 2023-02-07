<?php
require_once 'bootstrap.php';

$testopost = htmlspecialchars($_POST["description-input"]);
$datapost = date("20y-m-d h:m:s");
$autore = $_SESSION["username"];

$categorie = $mysqli->ottieniCategorie();
$categorie_inserite = array();
foreach ($categorie as $categoria) {
    if (isset($_POST["categoria_" . $categoria["idcategoria"]])) {
        array_push($categorie_inserite, $categoria["idcategoria"]);
    }
}

list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["image-input"]);
if ($result != 0) {
    $imgpost = $msg;
    $id = $mysqli->inserisciPost((int) $mysqli->ottieniIdUltimoPost()[0] + 1, $imgpost, $testopost, $datapost, $autore);
    if ($id != false) {
        foreach ($categorie_inserite as $categoria) {
            $ris = $mysqli->inserisciCategoriaPost((int) $categoria, (int) $mysqli->ottieniIdUltimoPost());
        }
        header("location: index.php");
    }
} else {
    $id = $mysqli->inserisciPost($mysqli->ottieniIdUltimoPost() + 1, NULL, $testopost, $datapost, $autore);
    if ($id != false) {
        foreach ($categorie_inserite as $categoria) {
            $ris = $mysqli->inserisciCategoriaPost($mysqli->ottieniIdUltimoPost(), $categoria["idcategoria"]);
        }
        header("location: index.php");
    }
}
