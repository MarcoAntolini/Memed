<?php

function registerLoggedUser($user)
{
    $_SESSION["username"] = $user["username"];
}

// TODO: fixare questa
function sec_session_start()
{
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function login($email, $password, $mysqli)
{
    if (!$ddd = $mysqli->ottieniUtenteDaEmail($email)) return false;
    $username = $ddd[0]['username'];
    $db_password = $ddd[0]['password'];
    $salt = $ddd[0]['salt'];
    $password = hash('sha512', $password . $salt);
    if ($db_password != $password) return false;
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    // $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
    $_SESSION['username'] = $username;
    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
    return true;
}

function login_check($mysqli)
{
    if (!isset($_SESSION['username'], $_SESSION['login_string'])) return false;
    $login_string = $_SESSION['login_string'];
    $username = $_SESSION['username'];
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    if (!$stmt = $mysqli->ottieniUtente($username)) return false;
    $password = $stmt[0]['password'];
    $login_check = hash('sha512', $password . $user_browser);
    if ($login_check != $login_string) return false;
    return true;
}

function uploadImage($path, $image)
{
    $imageName = basename($image["name"]);
    $fullPath = $path . $imageName;

    $maxKB = 5000;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Accettate solo le seguenti estensioni: " . implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $i = 1;
        do {
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME) . "_$i." . $imageFileType;
        } while (file_exists($path . $imageName));
        $fullPath = $path . $imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if (strlen($msg) == 0) {
        if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
            $msg .= "Errore nel caricamento dell'immagine.";
        } else {
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}