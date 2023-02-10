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
        $sql = "INSERT INTO utenti (username, email, password, salt, nomefile, bio) VALUES (?, ?, ?, ?,?, ?)";
        $stmt = $this->db->prepare($sql);
        $nomefile = '../../public/assets/img/default-pic.png';
        $bio = '';
        $stmt->bind_param("ssssss", $username, $email, $password, $salt, $nomefile, $bio);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciPost($idpost, $nomefile, $testo, $data, $username)
    {
        $sql = "INSERT INTO post (idpost, nomefile, testo, data, username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issss", $idpost, $nomefile, $testo, $data, $username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPost($idpost)
    {
        $sql = "SELECT * FROM post WHERE idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function inserisciCommento($idcommento, $testo, $data, $username, $idpost)
    {
        $sql = "INSERT INTO commento (idpost, username, idcommento, testo, data) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isiss", $idpost, $username, $idcommento, $testo, $data);
        if ($stmt->execute() === TRUE) {
            $post = $this->ottieniPost($idpost);
            $this->inserisciNotifica(
                "<a  href=\"user.php?username='$username'\">'$username'</a> ha commentato un tuo post",
                (int)$this->ottieniIdUltimaNotifica()[0] + 1,
                $post[4],
                $data
            );
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCategoriaPost($IDcategoria, $idpost)
    {
        $sql = "INSERT INTO categoria_post (idpost, IDcategoria) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $idpost, $IDcategoria);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCategoria($nome, $idcategoria)
    {
        $sql = "INSERT INTO categoria (idcategoria, nome) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $idcategoria, $nome);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciNotifica($messaggio, $idnotifica, $username, $data)
    {
        $sql =  "INSERT INTO notifica (username, idnotifica, mesaggio, data, letto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $letto = 0;
        $stmt->bind_param("sissi", $username, $idnotifica, $messaggio, $data, $letto);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaReazionePost($username, $idpost)
    {
        $sql = "DELETE FROM reazione_pu WHERE username = ? AND idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $username, $idpost);
        $stmt->execute();
    }

    public function inserisciReazionePost($username, $idpost, $idreazione)
    {
        $this->cancellaReazionePost($username, $idpost);
        $sql = "INSERT INTO reazione_pu (idreazione, username, idpost) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isi", $idreazione, $username, $idpost);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSalva($username, $idpost)
    {
        $sql = "INSERT INTO salva (idpost, username) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $idpost, $username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function controllaSalva($username, $idpost)
    {
        $sql = "SELECT * FROM salva WHERE username = ? AND idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $username, $idpost);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaSalva($username, $idpost)
    {
        $sql = "DELETE FROM salva WHERE username = ? AND idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $username, $idpost);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSegue($Fol_username, $username)
    {
        $sql = "INSERT INTO segue (Fol_username, username) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Fol_username, $username);
        if ($stmt->execute() === TRUE) {
            $this->inserisciNotifica(
                "<a  href=\"user.php?username='$username'\">'$username'</a> ha iniziato a seguirti",
                (int)$this->ottieniIdUltimaNotifica()[0] + 1,
                $Fol_username,
                date("Y-m-d H:i:s")
            );
            return true;
        } else {
            return false;
        }
    }

    public function controllaSegue($Fol_username, $username)
    {
        $sql = "SELECT * FROM segue WHERE Fol_username = ? AND username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Fol_username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaSegui($Fol_username, $username)
    {
        $sql = "DELETE FROM segue WHERE Fol_username = ? AND username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Fol_username, $username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPostSalvati($username)
    {
        $sql = "SELECT * FROM post WHERE idpost IN (SELECT idpost FROM salva WHERE username = ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniCategorie()
    {
        $sql = "SELECT * FROM categoria";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottienicategoriePost($idpost)
    {
        $sql = "SELECT * FROM categoria_post WHERE idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostDaUtente($username)
    {
        $sql = "SELECT * FROM post WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostPerHome($username)
    {
        $sql = "SELECT * FROM post WHERE username IN (SELECT Fol_username FROM segue WHERE username = ?) ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniCommentiPerPost($idpost)
    {
        $sql = "SELECT * FROM commento WHERE idpost = ? ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostDaCategoria($IDcategoria)
    {
        $sql = "SELECT * FROM post WHERE idpost IN (SELECT idpost FROM categoriapost WHERE IDcategoria = ?) ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $IDcategoria);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostPerEsplora($username)
    {
        // TODO: da finire
        $sql = "SELECT * FROM post WHERE username != ? ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function modificaPost($idpost, $testo)
    {
        $query = "UPDATE post SET testo = ? WHERE idpost = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $testo, $idpost);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaPost($idpost)
    {
        $this->cancellaCommentoDaPost($idpost);
        $this->cancellaReazioneDaPost($idpost);
        $this->cancellaPostSalvato($idpost);
        $sql = "DELETE FROM post WHERE idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaPostSalvato($idpost)
    {
        $sql = "DELETE FROM salva WHERE idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaCommentoDaPost($idpost)
    {
        $sql = "DELETE FROM commento WHERE idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaNotifica($idnotifica)
    {
        $sql = "DELETE FROM notifica WHERE idnotifica = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idnotifica);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaTutteNotifiche($username)
    {
        $sql = "DELETE FROM notifica WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function leggiTutteNotifiche($username)
    {
        $sql = "UPDATE notifica SET letto = '1' WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniNotifica($username)
    {
        $sql = "SELECT * FROM notifica WHERE username = ? ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function leggiNotifica($idnotifica)
    {
        $sql = "UPDATE notifica SET letto = '1' WHERE idnotifica = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idnotifica);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaReazioneDaPost($idpost)
    {
        $sql = "DELETE FROM reazione_pu WHERE idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idpost);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniSeguiti($username)
    {
        $sql = "SELECT Fol_username FROM segue WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniFollower($Fol_username)
    {
        $sql = "SELECT username FROM segue WHERE Fol_username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Fol_username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniIdUltimoPost()
    {
        $sql = "SELECT idpost FROM post ORDER BY idpost DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniIdUltimoCommento()
    {
        $sql = "SELECT idcommento FROM commento ORDER BY idcommento DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniIdUltimaNotifica()
    {
        $sql = "SELECT idnotifica FROM notifica ORDER BY idnotifica DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniUtente($username)
    {
        $sql = "SELECT * FROM utenti WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniUtenteDaEmail($email)
    {
        $sql = "SELECT * FROM utenti WHERE email = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniReazione($idreazione)
    {
        $sql = "SELECT * FROM reazione WHERE idreazione = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $idreazione);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaPostConReazione($idpost, $idreazione)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE idpost = ? AND idreazione = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $idpost, $idreazione);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaReazioniPost($idreazione, $idpost)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE idreazione = ? AND idpost = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $idreazione, $idpost);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaSeguiti($username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaFollower($Fol_username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE Fol_username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Fol_username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaNotifiche($username)
    {
        $sql = "SELECT COUNT(*) FROM notifica WHERE username = ? and letto = ?";
        $stmt = $this->db->prepare($sql);
        $letto = 0;
        $stmt->bind_param("si", $username, $letto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaPost($username)
    {
        $sql = "SELECT COUNT(*) FROM post WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniUtenteLoggato($username, $password)
    {
        $sql = "SELECT * FROM utente WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniUtentiPerNome($username)
    {
        $sql = "SELECT username, email, nomefile, bio FROM utenti WHERE username LIKE ?";
        $stmt = $this->db->prepare($sql);
        $username = "%" . $username . "%";
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function modificaProfilo($username, $nomefile, $bio)
    {
        $sql = "UPDATE utenti SET nomefile = ?, bio = ? WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $nomefile, $bio, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
