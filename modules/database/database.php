<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $Username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $Username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getMysqli()
    {
        return $this->db;
    }

    public function inserisciUtente($Username, $email, $password, $salt)
    {
        $sql = "INSERT INTO utenti (Username, email, password, salt, nomefile, bio) VALUES (?, ?, ?, ?,?, ?)";
        $stmt = $this->db->prepare($sql);
        $nomefile = 'default-pic.png';
        $bio = '';
        $stmt->bind_param("ssssss", $Username, $email, $password, $salt, $nomefile, $bio);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciPost($PostID, $nomefile, $TextContent, $DateAndTime, $Username)
    {
        $sql = "INSERT INTO post (PostID, nomefile, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issss", $PostID, $nomefile, $TextContent, $DateAndTime, $Username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPost($PostID)
    {
        $sql = "SELECT * FROM post WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function inserisciCommento($CommentID, $TextContent, $DateAndTime, $Username, $PostID)
    {
        $sql = "INSERT INTO comments (PostID, Username, CommentID, TextContent, DateAndTime) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isiss", $PostID, $Username, $CommentID, $TextContent, $DateAndTime);
        if ($stmt->execute() === TRUE) {
            $post = $this->ottieniPost($PostID);
            $this->inserisciNotifica(
                "<a  href=\"user.php?Username=$Username\" class=\"fw-bold\">$Username</a> ha commentato un tuo post.",
                (int)$this->ottieniIdUltimaNotifica()[0] + 1,
                $post[4],
                $DateAndTime
            );
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCategoriaPost($CategoryID, $PostID)
    {
        $sql = "INSERT INTO post_categories (PostID, CategoryID) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $PostID, $CategoryID);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCategoria($Name, $CategoryID)
    {
        $sql = "INSERT INTO categories (CategoryID, Name) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $CategoryID, $Name);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciNotifica($messaggio, $idnotifica, $Username, $DateAndTime)
    {
        $sql =  "INSERT INTO notifica (Username, idnotifica, mesaggio, DateAndTime, letto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $letto = 0;
        $stmt->bind_param("sissi", $Username, $idnotifica, $messaggio, $DateAndTime, $letto);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaReazionePost($Username, $PostID)
    {
        $sql = "DELETE FROM reazione_pu WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        $stmt->execute();
    }

    private function controlloReazione($Username, $PostID, $idreazione)
    {
        $sql = "SELECT * FROM reazione_pu WHERE Username = ? AND PostID = ? AND idreazione = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sii", $Username, $PostID, $idreazione);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function inserisciReazionePost($Username, $PostID, $idreazione)
    {
        if ($this->controlloReazione($Username, $PostID, $idreazione)) {
            $this->cancellaReazionePost($Username, $PostID);
            return true;
        }
        $this->cancellaReazionePost($Username, $PostID);
        $sql = "INSERT INTO reazione_pu (idreazione, Username, PostID) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isi", $idreazione, $Username, $PostID);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSalva($Username, $PostID)
    {
        $sql = "INSERT INTO salva (PostID, Username) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $PostID, $Username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function controllaSalva($Username, $PostID)
    {
        $sql = "SELECT * FROM salva WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaSalva($Username, $PostID)
    {
        $sql = "DELETE FROM salva WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSegue($Fol_username, $Username)
    {
        $sql = "INSERT INTO segue (Fol_username, Username) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Fol_username, $Username);
        if ($stmt->execute() === TRUE) {
            $this->inserisciNotifica(
                "<a href=\"user.php?Username=$Username\" class=\"fw-bold\">$Username</a> ha iniziato a seguirti.",
                (int)$this->ottieniIdUltimaNotifica()[0] + 1,
                $Fol_username,
                date("Y-m-d H:i:s")
            );
            return true;
        } else {
            return false;
        }
    }

    public function controllaSegue($Fol_username, $Username)
    {
        $sql = "SELECT * FROM segue WHERE Fol_username = ? AND Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Fol_username, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaSegui($Fol_username, $Username)
    {
        $sql = "DELETE FROM segue WHERE Fol_username = ? AND Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Fol_username, $Username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPostSalvati($Username)
    {
        $sql = "SELECT * FROM post WHERE PostID IN (SELECT PostID FROM salva WHERE Username = ?) ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
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
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottienicategoriePost($PostID)
    {
        $sql = "SELECT * FROM post_categories WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostDaUtente($Username)
    {
        $sql = "SELECT * FROM post WHERE Username = ? ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostPerHome($Username)
    {
        $sql = "SELECT * FROM post WHERE Username IN (SELECT Fol_username FROM segue WHERE Username = ?) ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniCommentiPerPost($PostID)
    {
        $sql = "SELECT * FROM comments WHERE PostID = ? ORDER BY DateAndTime ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostDaCategoria($CategoryID, $Username)
    {
        $sql = "SELECT post.* FROM post, reazione_pu WHERE post.PostID=reazione_pu.PostID AND post.PostID IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND post.Username != ? GROUP BY post.PostID ORDER BY AVG(reazione_pu.idreazione) DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $CategoryID, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniPostPerEsplora($Username)
    {
        $sql = "SELECT post.* FROM post, reazione_pu WHERE post.PostID=reazione_pu.PostID AND post.Username != ? GROUP BY post.PostID ORDER BY AVG(reazione_pu.idreazione) DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function modificaPost($PostID, $TextContent)
    {
        $query = "UPDATE post SET TextContent = ? WHERE PostID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $TextContent, $PostID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaCatPost($PostID)
    {
        $sql = "DELETE FROM post_categories WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaPost($PostID)
    {
        $this->cancellaCommentoDaPost($PostID);
        $this->cancellaReazioneDaPost($PostID);
        $this->cancellaPostSalvato($PostID);
        $this->cancellaCatPost($PostID);
        $sql = "DELETE FROM post WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaPostSalvato($PostID)
    {
        $sql = "DELETE FROM salva WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaCommentoDaPost($PostID)
    {
        $sql = "DELETE FROM comments WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
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

    public function cancellaTutteNotifiche($Username)
    {
        $sql = "DELETE FROM notifica WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function leggiTutteNotifiche($Username)
    {
        $sql = "UPDATE notifica SET letto = '1' WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniNotifica($Username)
    {
        $sql = "SELECT * FROM notifica WHERE Username = ? ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
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

    private function cancellaReazioneDaPost($PostID)
    {
        $sql = "DELETE FROM reazione_pu WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniSeguiti($Username)
    {
        $sql = "SELECT Fol_username FROM segue WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
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
        $sql = "SELECT Username FROM segue WHERE Fol_username = ?";
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
        $sql = "SELECT PostID FROM post ORDER BY PostID DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniIdUltimoCommento($PostID)
    {
        $sql = "SELECT CommentID FROM comments WHERE PostID = ? ORDER BY CommentID DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return array(0);
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

    public function ottieniUtente($Username)
    {
        $sql = "SELECT * FROM utenti WHERE Username = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
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

    public function contaPostConReazione($PostID, $idreazione)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE PostID = ? AND idreazione = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $PostID, $idreazione);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaReazioniPost($idreazione, $PostID)
    {
        $sql = "SELECT COUNT(*) FROM reazione_pu WHERE idreazione = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $idreazione, $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaSeguiti($Username)
    {
        $sql = "SELECT COUNT(*) FROM segue WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
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

    public function contaNotifiche($Username)
    {
        $sql = "SELECT COUNT(*) FROM notifica WHERE Username = ? and letto = ?";
        $stmt = $this->db->prepare($sql);
        $letto = 0;
        $stmt->bind_param("si", $Username, $letto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaPost($Username)
    {
        $sql = "SELECT COUNT(*) FROM post WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function ottieniUtenteLoggato($Username, $password)
    {
        $sql = "SELECT * FROM utente WHERE Username = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniUtentiPerNome($Username)
    {
        $sql = "SELECT Username, email, nomefile, bio FROM utenti WHERE Username LIKE ?";
        $stmt = $this->db->prepare($sql);
        $Username = "%" . $Username . "%";
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function modificaProfilo($Username, $nomefile, $bio)
    {
        $sql = "UPDATE utenti SET nomefile = ?, bio = ? WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $nomefile, $bio, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


    public function ottieniNomeFile($Username)
    {
        $sql = "SELECT nomefile FROM utenti WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function ottieniMediaReazioni($Username)
    {
        $sql = "SELECT AVG(reazione_pu.idreazione) FROM post, reazione_pu WHERE post.PostID=reazione_pu.PostID AND post.Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function ottieniReazionePost($PostID, $Username)
    {
        $sql = "SELECT idreazione FROM reazione_pu WHERE PostID = ? AND Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $PostID, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result == null) {
            return 0;
        } else if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }
}
