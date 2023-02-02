<?php
require_once 'bootstrap.php';

if(login_check($mysqli) == true) {
    $templateParams["titolo"]="Memed - new post";
    $templateParams["nome"]=""; //file da usare 
    $templateParams["username"]=$_SESSION["username"];

} else {
    echo 'You are not authorized to access this page, please login. <br/>';
 }

require 'view/logged-base-view.php';
