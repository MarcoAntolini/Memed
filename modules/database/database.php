<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function inserisciUtente($username, $email, $password)
    {
        $sql = "INSERT INTO utente (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciPost($idpost, $nomefile, $testo, $data, $username)
    {
        $sql = "INSERT INTO post (idpost, nomefile, testo, data, username) VALUES ('$idpost', '$nomefile', '$testo', '$data', '$username')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCommento($idcommento, $testo, $data, $username, $idpost)
    {
        $sql = "INSERT INTO commento (idpost, username, idcommento, testo, data) VALUES ('$idpost', '$username', '$idcommento', '$testo', '$data')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCategoriaPost($IDcategoria, $idpost)
    {
        $sql = "INSERT INTO categoria_post (idpost, IDcategoria) VALUES ('$idpost', '$IDcategoria')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCategoria($nome, $idcategoria)
    {
        $sql = "INSERT INTO categoria (idcategoria, nome) VALUES ('$idcategoria', '$nome')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciNotifica($messaggio, $idnotifica, $username, $data)
    {
        $sql =  "INSERT INTO notifica (username, idnotifica, messaggio, data) VALUES ('$username', '$idnotifica', '$messaggio', '$data')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaReazionePost($username, $idpost)
    {
        $sql = "DELETE FROM reazione_pu WHERE username = '$username' AND idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciReazionePost($username, $idpost, $idreazione)
    {
        $this->cancellaReazionePost($username, $idpost);
        $sql = "INSERT INTO reazione_pu (idreazione, username, idpost) VALUES ('$idreazione', '$username', '$idpost')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSalva($username, $idpost)
    {
        $sql = "INSERT INTO salva (idpost, username) VALUES ('$idpost', '$username')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSegue($Fol_IDuser, $username)
    {
        $sql = "INSERT INTO segue (Fol_IDuser, username) VALUES ('$Fol_IDuser', '$username')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPostDaUtente($username)
    {
        $sql = "SELECT * FROM post WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostPerHome($username)
    {
        $sql = "SELECT * FROM post WHERE username IN (SELECT Fol_username FROM segue WHERE username = '$username') ORDER BY data DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostDaCategoria($IDcategoria)
    {
        $sql = "SELECT * FROM post WHERE idpost IN (SELECT idpost FROM categoriapost WHERE IDcategoria = '$IDcategoria') ORDER BY data DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostPerEsplora()
    { //da finire
        $sql = "SELECT * FROM post WHERE idpost IN (SELECT idpost FROM) ORDER BY data DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaReazioniPost($idreazione, $idpost)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE idreazione = '$idreazione' AND idpost = '$idpost'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function cancellaPost($idpost)
    {
        $this->cancellaCommentoDaPost($idpost);
        $this->cancellaReazioneDaPost($idpost);
        $this->cancellaPostSalvato($idpost);
        $sql = "DELETE FROM post WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaPostSalvato($idpost)
    {
        $sql = "DELETE FROM salva WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaCommentoDaPost($idpost)
    {
        $sql = "DELETE FROM commento WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaNotifica($idnotifica)
    {
        $sql = "DELETE FROM notifica WHERE idnotifica = '$idnotifica'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniNotifica($username)
    {
        $sql = "SELECT * FROM notifica WHERE username = '$username' ORDER BY data DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $this->cancellaNotifica($result->fetch_all(MYSQLI_ASSOC)['idnotifica']);
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    private function cancellaReazioneDaPost($idpost)
    {
        $sql = "DELETE FROM reazione_pu WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniSeguiti($username)
    {
        $sql = "SELECT Fol_username FROM segue WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniFollower($Fol_username)
    {
        $sql = "SELECT username FROM segue WHERE Fol_username = '$Fol_username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniIdUltimoPost()
    {
        $sql = "SELECT idpost FROM post ORDER BY idpost DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniIdUltimoCommento()
    {
        $sql = "SELECT idcommento FROM commento ORDER BY idcommento DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniIdUltimaNotifica()
    {
        $sql = "SELECT idnotifica FROM notifica ORDER BY idnotifica DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniUtente($username)
    {
        $sql = "SELECT * FROM utente WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniReazione($idreazione)
    {
        $sql = "SELECT * FROM reazione WHERE idreazione = '$idreazione'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaPostConReazione($idpost, $idreazione)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE idpost = '$idpost' AND idreazione = '$idreazione'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaSeguiti($username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaFollower($Fol_username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE Fol_username = '$Fol_username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaNotifiche($username)
    {
        $sql = "SELECT COUNT(*) FROM notifica WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaPost($username)
    {
        $sql = "SELECT COUNT(*) FROM post WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getUserLogin($username, $password)
    {
        $sql = "SELECT * FROM utente WHERE username = '$username' AND password = '$password'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
}