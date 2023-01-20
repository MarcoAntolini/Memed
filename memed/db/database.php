<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function inserisciUtente($IDuser, $username, $email, $password){
        $sql = "INSERT INTO utente (IDuser, username, email, password) VALUES ('$IDuser', '$username', '$email', '$password')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciPost($idpost, $nomefile, $testo, $data, $IDuser){
        $sql = "INSERT INTO post (idpost, nomefile, testo, data, IDuser) VALUES ('$idpost', '$nomefile', '$testo', '$data', '$IDuser')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciCommento($idcommento, $testo, $data, $IDuser, $idpost){
        $sql = "INSERT INTO commento (IDuser, idpost, idcommento, testo, data) VALUES ('$IDuser', '$idpost', '$idcommento', '$testo', '$data')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inseriscicategoriapost($IDcategoria, $idpost){
        $sql = "INSERT INTO categoria_post (IDcategoria, idpost) VALUES ('$IDcategoria', '$idpost')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inseriscinotifica($messaggio, $idnotifica, $IDuser){
        $sql =  "INSERT INTO notifica (messaggio, idnotifica, IDuser) VALUES ('$messaggio', '$idnotifica', '$IDuser')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inseriscireazione_pu($IDuser, $idpost, $idreazione){
        $sql = "INSERT INTO reazione_pu (IDuser, idpost, idreazione) VALUES ('$IDuser', '$idpost', '$idreazione')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inseriscisalva($IDuser, $idpost){
        $sql = "INSERT INTO salva (IDuser, idpost) VALUES ('$IDuser', '$idpost')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inseriscisegue($Fol_IDuser, $IDuser){
        $sql = "INSERT INTO segue (Fol_IDuser, IDuser) VALUES ('$Fol_IDuser', '$IDuser')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostByUser($IDuser){
        $sql = "SELECT * FROM post WHERE IDuser = '$IDuser'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getPostForHome($IDuser){
        $sql = "SELECT * FROM post WHERE IDuser IN (SELECT Fol_IDuser FROM segue WHERE IDuser = '$IDuser') ORDER BY data DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getPostByCategory($IDcategoria){
        $sql = "SELECT * FROM post WHERE idpost IN (SELECT idpost FROM categoriapost WHERE IDcategoria = '$IDcategoria') ORDER BY data DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function deletePost($idpost){
        $sql = "DELETE FROM post WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCommentoForPost($idpost){
        $sql = "DELETE FROM commento WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNotifica($idnotifica){
        $sql = "DELETE FROM notifica WHERE idnotifica = '$idnotifica'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReazione_puForPost($idpost){
        $sql = "DELETE FROM reazione_pu WHERE idpost = '$idpost'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getseguiti($IDuser){
        $sql = "SELECT Fol_IDuser FROM segue WHERE IDuser = '$IDuser'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getfollower($Fol_IDuser){
        $sql = "SELECT IDuser FROM segue WHERE Fol_IDuser = '$Fol_IDuser'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getlastidpost(){
        $sql = "SELECT idpost FROM post ORDER BY idpost DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getlastiduser(){
        $sql = "SELECT IDuser FROM user ORDER BY IDuser DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getlastidcommento(){
        $sql = "SELECT idcommento FROM commento ORDER BY idcommento DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getlastidnotifica(){
        $sql = "SELECT idnotifica FROM notifica ORDER BY idnotifica DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getUser($IDuser){
        $sql = "SELECT * FROM utente WHERE IDuser = '$IDuser'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getUserByusername($username){
        $sql = "SELECT * FROM utente WHERE username = '$username'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
}