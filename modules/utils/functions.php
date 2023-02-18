<?php

function registerLoggedUser($user)
{
    $_SESSION["Username"] = $user["Username"];
}

function login($email, $password, $mysqli)
{
    if (!$ddd = $mysqli->ottieniUtenteDaEmail($email)) return false;
    $username = $ddd[0]['Username'];
    $db_password = $ddd[0]['Password'];
    $salt = $ddd[0]['PasswordSalt'];
    $password = hash('sha512', $password . $salt);
    if ($db_password != $password) return false;
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['Username'] = $username;
    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
    return true;
}

function login_check($mysqli)
{
    if (!isset($_SESSION['Username'], $_SESSION['login_string'])) return false;
    $login_string = $_SESSION['login_string'];
    $username = $_SESSION['Username'];
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    if (!$stmt = $mysqli->ottieniUtente($username)) return false;
    $password = $stmt[0]['Password'];
    $login_check = hash('sha512', $password . $user_browser);
    if ($login_check != $login_string) return false;
    return true;
}

function logout()
{
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    session_destroy();
}

function uploadImage($path, $image)
{
    $imageName = basename($image["name"]);
    $fullPath = $path . $imageName;

    $maxKB = 5000;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Accettate solo le seguenti estensioni: " . implode(",", $acceptedExtensions);
    }
    if (file_exists($fullPath)) {
        $i = 1;
        do {
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME) . "_$i." . $imageFileType;
        } while (file_exists($path . $imageName));
        $fullPath = $path . $imageName;
    }
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
