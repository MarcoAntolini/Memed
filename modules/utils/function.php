<?php

function registerLoggedUser($user){
    $_SESSION["username"] = $user["username"];
}

function sec_session_start() {
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

function login($email, $password, $mysqli) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    if ($stmt = $mysqli->prepare("SELECT username, password, salt FROM utenti WHERE email = ? LIMIT 1")) { 
       $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
       $stmt->execute(); // esegue la query appena creata.
       $ddd=$stmt->fetch_all(MYSQLI_ASSOC);
       $username=$ddd['username'];
       $db_password=$ddd['password'];
       $salt=$ddd['salt'];
       $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
       if($stmt->num_rows == 1) { // se l'utente esiste
          if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
             // Password corretta!            
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente. 
                $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                // Login eseguito con successo.
                return true;    
          } else {
             // Password incorretta.
             return false;
          }
       } else {
          // L'utente inserito non esiste.
          return false;
       }
    }
 }

 function login_check($mysqli) {
    // Verifica che tutte le variabili di sessione siano impostate correttamente
    if(isset($_SESSION['username'], $_SESSION['login_string'])) {
      $login_string = $_SESSION['login_string'];
      $username = $_SESSION['username'];     
      $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
      if ($stmt = $mysqli->prepare("SELECT password FROM utenti WHERE username = ? LIMIT 1")) { 
         $stmt->bind_param('i', $username); // esegue il bind del parametro '$username'.
         $stmt->execute(); // Esegue la query creata.
         $stmt->store_result();
  
         if($stmt->num_rows == 1) { // se l'utente esiste
            $password = $stmt->fetch_all(MYSQLI_ASSOC)['password'];
            $login_check = hash('sha512', $password.$user_browser);
            if($login_check == $login_string) {
               // Login eseguito!!!!
               return true;
            } else {
               //  Login non eseguito
               return false;
            }
         } else {
             // Login non eseguito
             return false;
         }
      } else {
         // Login non eseguito
         return false;
      }
    } else {
      // Login non eseguito
      return false;
    }
 }

?>
