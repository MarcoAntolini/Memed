<?php

function registerLoggedUser($user)
{
   $_SESSION["username"] = $user["username"];
}

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
   // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
   if (!$stmt = $mysqli->getMysqli()->prepare("SELECT username, password, salt FROM utenti WHERE email = ? LIMIT 1")) return false;
   $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
   $stmt->execute(); // esegue la query appena creata.
   $ddd = $stmt->fetch_all(MYSQLI_ASSOC);
   $username = $ddd['username'];
   $db_password = $ddd['password'];
   $salt = $ddd['salt'];
   $password = hash('sha512', $password . $salt); // codifica la password usando una chiave univoca.
   if ($stmt->num_rows != 1) return false; // l'utente non esiste
   if ($db_password != $password) return false; // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
   // Password corretta!            
   $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente. 
   $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
   $_SESSION['username'] = $username;
   $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
   // Login eseguito con successo.
   return true;
}

function login_check($mysqli)
{
   // Verifica che tutte le variabili di sessione siano impostate correttamente
   if (!isset($_SESSION['username'], $_SESSION['login_string'])) return false;
   $login_string = $_SESSION['login_string'];
   $username = $_SESSION['username'];
   $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
   if (!$stmt = $mysqli->getMysqli()->prepare("SELECT password FROM utenti WHERE username = ? LIMIT 1")) return false;
   $stmt->bind_param('i', $username); // esegue il bind del parametro '$username'.
   $stmt->execute(); // Esegue la query creata.
   $stmt->store_result();
   if ($stmt->num_rows != 1) return false; // l'utente non esiste
   $password = $stmt->fetch_all(MYSQLI_ASSOC)['password'];
   $login_check = hash('sha512', $password . $user_browser);
   if ($login_check != $login_string) return false; //  Login non eseguito
   return true; // Login eseguito!!!!
}

function uploadImage($path, $image){
   $imageName = basename($image["name"]);
   $fullPath = $path.$imageName;
   
   $maxKB = 5000;
   $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
   $result = 0;
   $msg = "";
   //Controllo se immagine è veramente un'immagine
   $imageSize = getimagesize($image["tmp_name"]);
   if($imageSize === false) {
       $msg .= "File caricato non è un'immagine! ";
   }
   //Controllo dimensione dell'immagine < 500KB
   if ($image["size"] > $maxKB * 1024) {
       $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
   }

   //Controllo estensione del file
   $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
   if(!in_array($imageFileType, $acceptedExtensions)){
       $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
   }

   //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
   if (file_exists($fullPath)) {
       $i = 1;
       do{
           $i++;
           $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
       }
       while(file_exists($path.$imageName));
       $fullPath = $path.$imageName;
   }

   //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
   if(strlen($msg)==0){
       if(!move_uploaded_file($image["tmp_name"], $fullPath)){
           $msg.= "Errore nel caricamento dell'immagine.";
       }
       else{
           $result = 1;
           $msg = $imageName;
       }
   }
   return array($result, $msg);
}

?>