<?php
require_once 'bootstrap.php';

$templeteParams["titilo"]="Memed";
$templeteParams["nome"]=""; //file da usare 
$templeteParams["username"]=$_SESSION["username"];
$templeteParams["posthome"]=$dbh->getPostForHome($_SESSION["username"]);
$templeteParams["numNotifiche"]=$dbh->countNotifiche($_SESSION["username"]);

require 'template/base.php';
?>