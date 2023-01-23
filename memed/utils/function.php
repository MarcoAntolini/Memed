<?php

function registerLoggedUser($user){
    $_SESSION["IDuser"] = $user["IDuser"];
    $_SESSION["username"] = $user["username"];
}

?>