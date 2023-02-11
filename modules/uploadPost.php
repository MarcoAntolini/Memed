<?php
require_once 'bootstrap.php';

if ((isset($_POST["description-input"]) && !empty($_POST["description-input"])) || (isset($_POST["image-input"]) && !empty($_POST["image-input"]["name"]))) {
    $testopost = htmlspecialchars($_POST["description-input"]);
    $datapost = date("Y-m-d H:i:s");
    $autore = $_SESSION["username"];

    $categorie = $mysqli->ottieniCategorie();
    $categorie_inserite = array();
    foreach ($categorie as $categoria) {
        if (isset($_POST["categoria_" . $categoria["idcategoria"]])) {
            array_push($categorie_inserite, $categoria["idcategoria"]);
        }
    }
    if (isset($_FILES["image-input"]) && $_FILES["image-input"]["name"] != "") {
        list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["image-input"]);
        if ($result != 0) {
            $imgpost = $msg;
            $id = $mysqli->inserisciPost((int) $mysqli->ottieniIdUltimoPost()[0] + 1, $imgpost, $testopost, $datapost, $autore);
            if ($id != false) {
                foreach ($categorie_inserite as $categoria) {
                    $ris = $mysqli->inserisciCategoriaPost((int) $categoria, (int) $mysqli->ottieniIdUltimoPost()[0]);
                }
                header("location: index.php");
            }
        } else {
            $id = $mysqli->inserisciPost($mysqli->ottieniIdUltimoPost()[0] + 1, NULL, $testopost, $datapost, $autore);
            if ($id != false) {
                foreach ($categorie_inserite as $categoria) {
                    $ris = $mysqli->inserisciCategoriaPost($categoria, $mysqli->ottieniIdUltimoPost()[0]);
                }
                header("location: index.php");
            }
        }
    } else {
        $id = $mysqli->inserisciPost($mysqli->ottieniIdUltimoPost()[0] + 1, NULL, $testopost, $datapost, $autore);
        if ($id != false) {
            foreach ($categorie_inserite as $categoria) {
                $ris = $mysqli->inserisciCategoriaPost($categoria, $mysqli->ottieniIdUltimoPost()[0]);
            }
            header("location: index.php");
        }
    }
} else {
    header("location: newPost.php");
}
