<?php
require_once 'bootstrap.php';

$templeteParams["titilo"]="Memed";
$templeteParams["nome"]=""; //file da usare 
$templeteParams["username"]=$dbh->getUser($_SESSION["IDuser"])["username"];
$templeteParams["posthome"]=$dbh->getPostForHome($_SESSION["IDuser"]);
$templeteParams["numNotifiche"]=$dbh->countNotifiche($_SESSION["IDuser"]);

require 'template/base.php';
?>