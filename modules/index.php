<?php
require_once 'bootstrap.php';

$templeteParams["titilo"]="Memed";
$templeteParams["nome"]=""; //file da usare 
$templeteParams["username"]=$_SESSION["username"];
$templeteParams["posthome"]=$mysqli->getPostForHome($_SESSION["username"]);
$templeteParams["numNotifiche"]=$mysqli->countNotifiche($_SESSION["username"]);

require 'template/base.php';
?>