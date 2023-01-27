<?php
require_once 'bootstrap.php';

if(login_check($mysqli) == true) {
    $templeteParams["titilo"]="Memed - new post";
    $templeteParams["nome"]=""; //file da usare 
    $templeteParams["username"]=$_SESSION["username"];

} else {
    echo 'You are not authorized to access this page, please login. <br/>';
 }

require 'template/base.php';
?>