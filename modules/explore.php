<?php
require_once 'bootstrap.php';

if (login_check($mysqli) == true) {
    $templateParams["titolo"] = "Memed - Esplora";
    $templateParams["nome"] = "../template/explore-view.php";
} else {
    header("location: login.php");
}

require "../template/logged-base-view.php";
