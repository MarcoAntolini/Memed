<?php
require_once 'bootstrap.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $result = $mysqli("SELECT username FROM users WHERE username LIKE '%$username%'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>" . $row['username'] . "</div>";
        }
    } else {
        echo "<div>Nessun risultato.</div>";
    }
}

require "../template/base/logged-base-view.php";
