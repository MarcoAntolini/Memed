<?php
require_once 'bootstrap.php';

    //Inserisco
    $testopost = htmlspecialchars($_POST["testopost"]);
    $datapost = date("Y-m-d");
    $autore = $_SESSION["username"];

    $categorie = $mysqli->ottieniCategorie();
    $categorie_inserite = array();
    foreach($categorie as $categoria){
        if(isset($_POST["categoria_".$categoria["idcategoria"]])){
            array_push($categorie_inserite, $categoria["idcategoria"]);
        }
    }

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["imgpost"]);
    if($result != 0){
        $imgpost = $msg;
        $id = $mysqli->inserisciPost($mysqli->ottieniIdUltimoPost()+1, $imgpost, $testopost, $datapost, $autore);
        if($id!=false){
            foreach($categorie_inserite as $categoria){
                $ris = $mysqli->inserisciCategoriaPost($mysqli->ottieniIdUltimoPost(), $categoria["idcategoria"]);
            }
            header("location: index.php");
        }
    }else{
        $id = $mysqli->inserisciPost($mysqli->ottieniIdUltimoPost()+1, NULL, $testopost, $datapost, $autore);
        if($id!=false){
            foreach($categorie_inserite as $categoria){
                $ris = $mysqli->inserisciCategoriaPost($mysqli->ottieniIdUltimoPost(), $categoria["idcategoria"]);
            }
            header("location: index.php");
        }
    }


?>