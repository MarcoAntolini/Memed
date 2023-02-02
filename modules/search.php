<?php
require_once 'bootstrap.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $result = $mysqli("SELECT username FROM users WHERE username LIKE '%$username%'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['username'] . "\n";
        }
    } else {
        echo "Nessun risultato.";
    }
}

require "../view/logged-base-view.php";