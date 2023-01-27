<?php
require_once 'bootstrap.php';

if(login_check($mysqli) == true) {
    $templeteParams["titilo"]="Memed";
    $templeteParams["nome"]=""; //file da usare 
    $templeteParams["username"]=$_SESSION["username"];
    $templeteParams["posthome"]=$mysqli->getPostForHome($_SESSION["username"]);
    $templeteParams["numNotifiche"]=$mysqli->countNotifiche($_SESSION["username"]);
 } else {
    echo 'You are not authorized to access this page, please login. <br/>';
 }

require 'template/base.php';
?>