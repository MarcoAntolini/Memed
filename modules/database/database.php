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

    public function inserisciUtente($Username, $Email, $Password, $PasswordSalt)
    {
        $sql = "INSERT INTO users (Username, Email, Password, PasswordSalt, FileName, Bio) VALUES (?, ?, ?, ?,?, ?)";
        $stmt = $this->db->prepare($sql);
        $FileName = 'default-pic.png';
        $Bio = '';
        $stmt->bind_param("ssssss", $Username, $Email, $Password, $PasswordSalt, $FileName, $Bio);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciPost($PostID, $FileName, $TextContent, $DateAndTime, $Username)
    {
        $sql = "INSERT INTO posts (PostID, FileName, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issss", $PostID, $FileName, $TextContent, $DateAndTime, $Username);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPost($PostID)
    {
        $sql = "SELECT * FROM posts WHERE PostID = ?";
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

    public function inserisciNotifica($messaggio, $NotificationID, $Username, $DateAndTime)
    {
        $sql =  "INSERT INTO notifications (Username, NotificationID, Message, DateAndTime, Read) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $Read = 0;
        $stmt->bind_param("sissi", $Username, $NotificationID, $messaggio, $DateAndTime, $Read);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaReazionePost($Username, $PostID)
    {
        $sql = "DELETE FROM post_reactions WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        $stmt->execute();
    }

    private function controlloReazione($Username, $PostID, $ReactionID)
    {
        $sql = "SELECT * FROM post_reactions WHERE Username = ? AND PostID = ? AND ReactionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sii", $Username, $PostID, $ReactionID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function inserisciReazionePost($Username, $PostID, $ReactionID)
    {
        if ($this->controlloReazione($Username, $PostID, $ReactionID)) {
            $this->cancellaReazionePost($Username, $PostID);
            return true;
        }
        $this->cancellaReazionePost($Username, $PostID);
        $sql = "INSERT INTO post_reactions (ReactionID, Username, PostID) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isi", $ReactionID, $Username, $PostID);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSalva($Username, $PostID)
    {
        $sql = "INSERT INTO saved_posts (PostID, Username) VALUES (?, ?)";
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
        $sql = "SELECT * FROM saved_posts WHERE Username = ? AND PostID = ?";
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
        $sql = "DELETE FROM saved_posts WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function inserisciSegue($FollowedUsername, $FollowerUsername)
    {
        $sql = "INSERT INTO follows (FollowedUsername, FollowerUsername) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $FollowedUsername, $FollowerUsername);
        if ($stmt->execute() === TRUE) {
            $this->inserisciNotifica(
                "<a href=\"user.php?Username=$FollowerUsername\" class=\"fw-bold\">$FollowerUsername</a> ha iniziato a seguirti.",
                (int)$this->ottieniIdUltimaNotifica()[0] + 1,
                $FollowedUsername,
                date("Y-m-d H:i:s")
            );
            return true;
        } else {
            return false;
        }
    }

    public function controllaSegue($FollowedUsername, $FollowerUsername)
    {
        $sql = "SELECT * FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $FollowedUsername, $FollowerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaSegui($FollowedUsername, $FollowerUsername)
    {
        $sql = "DELETE FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $FollowedUsername, $FollowerUsername);
        if ($stmt->execute() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniPostSalvati($Username)
    {
        $sql = "SELECT * FROM posts WHERE PostID IN (SELECT PostID FROM saved_posts WHERE Username = ?) ORDER BY DateAndTime DESC";
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
        $sql = "SELECT * FROM posts WHERE Username = ? ORDER BY DateAndTime DESC";
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
        $sql = "SELECT * FROM posts WHERE Username IN (SELECT FollowedUsername FROM follows WHERE Username = ?) ORDER BY DateAndTime DESC";
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
        $sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.PostID IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
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
        $sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
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
        $query = "UPDATE posts SET TextContent = ? WHERE PostID = ?";
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
        $sql = "DELETE FROM posts WHERE PostID = ?";
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
        $sql = "DELETE FROM saved_posts WHERE PostID = ?";
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

    public function cancellaNotifica($NotificationID)
    {
        $sql = "DELETE FROM notifications WHERE NotificationID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $NotificationID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancellaTutteNotifiche($Username)
    {
        $sql = "DELETE FROM notifications WHERE Username = ?";
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
        $sql = "UPDATE notifications SET Read = '1' WHERE Username = ?";
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
        $sql = "SELECT * FROM notifications WHERE Username = ? ORDER BY DateAndTime DESC";
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

    public function leggiNotifica($NotificationID)
    {
        $sql = "UPDATE notifications SET Read = '1' WHERE NotificationID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $NotificationID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function cancellaReazioneDaPost($PostID)
    {
        $sql = "DELETE FROM post_reactions WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ottieniSeguiti($FollowerUsername)
    {
        $sql = "SELECT FollowedUsername FROM follows WHERE FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $FollowerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniFollower($FollowedUsername)
    {
        $sql = "SELECT FollowerUsername FROM follows WHERE FollowedUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $FollowedUsername);
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
        $sql = "SELECT PostID FROM posts ORDER BY PostID DESC LIMIT 1";
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
        $sql = "SELECT NotificationID FROM notifications ORDER BY NotificationID DESC LIMIT 1";
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
        $sql = "SELECT * FROM users WHERE Username = ? LIMIT 1";
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

    public function ottieniUtenteDaEmail($Email)
    {
        $sql = "SELECT * FROM users WHERE Email = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function ottieniReazione($ReactionID)
    {
        $sql = "SELECT * FROM reactions WHERE ReactionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $ReactionID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function contaPostConReazione($PostID, $ReactionID)
    {
        $sql = "SELECT COUNT(*) FROM post_reactions WHERE PostID = ? AND ReactionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $PostID, $ReactionID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaReazioniPost($ReactionID, $PostID)
    {
        $sql = "SELECT COUNT(*) FROM post_reactions WHERE ReactionID = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $ReactionID, $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaSeguiti($FollowerUsername)
    {
        $sql = "SELECT COUNT(*) FROM follows WHERE FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $FollowerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return false;
        }
    }

    public function contaFollower($FollowedUsername)
    {
        $sql = "SELECT COUNT(*) FROM follows WHERE FollowedUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $FollowedUsername);
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
        $sql = "SELECT COUNT(*) FROM notifications WHERE Username = ? and Read = ?";
        $stmt = $this->db->prepare($sql);
        $Read = 0;
        $stmt->bind_param("si", $Username, $Read);
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
        $sql = "SELECT COUNT(*) FROM posts WHERE Username = ?";
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

    public function ottieniUtenteLoggato($Username, $Password)
    {
        $sql = "SELECT * FROM utente WHERE Username = ? AND Password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $Username, $Password);
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
        $sql = "SELECT Username, Email, FileName, Bio FROM users WHERE Username LIKE ?";
        $stmt = $this->db->prepare($sql);
        $Username = "%" . $Username . "%";
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function modificaProfilo($Username, $FileName, $Bio)
    {
        $sql = "UPDATE users SET FileName = ?, Bio = ? WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $FileName, $Bio, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


    public function ottieniNomeFile($Username)
    {
        $sql = "SELECT FileName FROM users WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function ottieniMediaReazioni($Username)
    {
        $sql = "SELECT AVG(post_reactions.ReactionID) FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function ottieniReazionePost($PostID, $Username)
    {
        $sql = "SELECT ReactionID FROM post_reactions WHERE PostID = ? AND Username = ?";
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
