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

    public function getMysqli()
    {
        return $this->db;
    }

    public function inserisciUtente($username, $email, $password, $salt)
    {
        $sql = "INSERT INTO utenti (username, email, password, salt, nomefile, bio)
                VALUES ('$username', '$email', '$password', '$salt', '../public/assets/img/default-pic.png', '')";
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

    public function ottienePost($idpost)
    {
        $sql = "select * form post where idpost = '$idpost'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function inserisciCommento($idcommento, $testo, $data, $username, $idpost)
    {
        $sql = "INSERT INTO commento (idpost, username, idcommento, testo, data) VALUES ('$idpost', '$username', '$idcommento', '$testo', '$data')";
        if ($this->db->query($sql) === TRUE) {
            $this->inserisciNotifica(
                "<a  href=\"user.php?username='$username'\">'$username'</a> ha commentato un tuo post",
                (int)$this->ottieniIdUltimaNotifica() + 1,
                $this->ottienePost($idpost)["username"],
                $data
            );
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
        $sql =  "INSERT INTO notifica (username, idnotifica, messaggio, data, letto) VALUES ('$username', '$idnotifica', '$messaggio', '$data', 0)";
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

    public function inserisciSegue($Fol_username, $username)
    {
        $sql = "INSERT INTO segue (Fol_username, username) VALUES ('$Fol_username', '$username')";
        if ($this->db->query($sql) === TRUE) {
            $this->inserisciNotifica(
                "<a  href=\"user.php?username='$username'\">'$username'</a> ha iniziato a seguirti",
                (int) $this->ottieniIdUltimaNotifica() + 1,
                $Fol_username,
                date("Y-m-d H:i:s")
            );
            return true;
        } else {
            return false;
        }
    }

    public function ottieniCategorie()
    {
        $sql = "SELECT * FROM categoria";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottienicategoriePost($idpost)
    {
        $sql = "SELECT * FROM categoria_post WHERE idpost = '$idpost'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
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

    public function ottieniCommentiPerPost($idpost)
    {
        $sql = "SELECT * FROM commento WHERE idpost = '$idpost' ORDER BY data DESC";
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

    public function ottieniPostPerEsplora($username)
    {
        // TODO: da finire
        $sql = "SELECT * FROM post WHERE username != '$username' ORDER BY data DESC";
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

    public function cancellaNotifica($idnotifica)
    {
        $sql = "DELETE FROM notifica WHERE idnotifica = '$idnotifica'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaTutteNotifiche($username)
    {
        $sql = "DELETE FROM notifica WHERE username = '$username'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function leggiTutteNotifiche($username)
    {
        $sql = "UPDATE notifica SET letto = '1' WHERE username = '$username'";
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
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function leggiNotifica($idnotifica)
    {
        $sql = "UPDATE notifica SET letto = '1' WHERE idnotifica = '$idnotifica'";
        if ($this->db->query($sql) === TRUE) {
            return true;
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
            return $result->fetch_row();
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
        $sql = "SELECT * FROM utenti WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniUtenteDaEmail($email)
    {
        $sql = "SELECT * FROM utenti WHERE email = '$email' LIMIT 1";
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
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaReazioniPost($idreazione, $idpost)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE idreazione = '$idreazione' AND idpost = '$idpost'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaSeguiti($username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaFollower($Fol_username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE Fol_username = '$Fol_username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaNotifiche($username)
    {
        $sql = "SELECT COUNT(*) FROM notifica WHERE username = '$username' and letto = 0";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaPost($username)
    {
        $sql = "SELECT COUNT(*) FROM post WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniUtenteLoggato($username, $password)
    {
        $sql = "SELECT * FROM utente WHERE username = '$username' AND password = '$password'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniUtentiPerNome($username)
    {
        $sql = "SELECT username, email, nomefile, bio FROM utenti WHERE username LIKE '%$username%'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
