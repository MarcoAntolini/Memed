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

    public function insertUser($Username, $Email, $Password, $PasswordSalt)
    {
        $sql = "INSERT INTO users (Username, Email, Password, PasswordSalt, FileName, Bio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $FileName = 'default-pic.png';
        $Bio = '';
        $stmt->bind_param("ssssss", $Username, $Email, $Password, $PasswordSalt, $FileName, $Bio);
        $stmt->execute();
    }

    public function insertPost($PostID, $FileName, $TextContent, $DateAndTime, $Username)
    {
        $sql = "INSERT INTO posts (PostID, FileName, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issss", $PostID, $FileName, $TextContent, $DateAndTime, $Username);
        $stmt->execute();
    }

    public function getPostById($PostID)
    {
        $sql = "SELECT * FROM posts WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function insertComment($CommentID, $TextContent, $DateAndTime, $Username, $PostID)
    {
        $sql = "INSERT INTO comments (PostID, Username, CommentID, TextContent, DateAndTime) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isiss", $PostID, $Username, $CommentID, $TextContent, $DateAndTime);
        // if ($stmt->execute() === TRUE) {
        $post = $this->getPostById($PostID);
        $this->insertNotification(
            "<a href=\"user.php?Username=$Username\" class=\"fw-bold\">$Username</a> ha commentato un tuo post.",
            (int)$this->getLastNotificationId()[0] + 1,
            $post[4],
            $DateAndTime
        );
        // return true;
        // } else {
        // return false;
        // }
    }

    public function insertPostCategory($CategoryID, $PostID)
    {
        $sql = "INSERT INTO post_categories (PostID, CategoryID) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $PostID, $CategoryID);
        $stmt->execute();
    }

    // public function inserisciCategoria($Name, $CategoryID)
    // {
    //     $sql = "INSERT INTO categories (CategoryID, Name) VALUES (?, ?)";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("is", $CategoryID, $Name);
    //     $stmt->execute();
    // }

    public function insertNotification($messaggio, $NotificationID, $Username, $DateAndTime)
    {
        $sql =  "INSERT INTO notifications (Username, NotificationID, Message, DateAndTime, `Read`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $Read = 0;
        $stmt->bind_param("sissi", $Username, $NotificationID, $messaggio, $DateAndTime, $Read);
        $stmt->execute();
    }

    private function deleteReactionOfUserFromPost($Username, $PostID)
    {
        $sql = "DELETE FROM post_reactions WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        $stmt->execute();
    }

    private function checkReaction($Username, $PostID, $ReactionID)
    {
        $sql = "SELECT * FROM post_reactions WHERE Username = ? AND PostID = ? AND ReactionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sii", $Username, $PostID, $ReactionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function insertReactionOfPost($Username, $PostID, $ReactionID)
    {
        if ($this->checkReaction($Username, $PostID, $ReactionID)) {
            $this->deleteReactionOfUserFromPost($Username, $PostID);
            return true;
        }
        $this->deleteReactionOfUserFromPost($Username, $PostID);
        $sql = "INSERT INTO post_reactions (ReactionID, Username, PostID) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isi", $ReactionID, $Username, $PostID);
        $stmt->execute();
    }

    public function insertSavedPost($Username, $PostID)
    {
        $sql = "INSERT INTO saved_posts (PostID, Username) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $PostID, $Username);
        $stmt->execute();
    }

    public function checkSavedPost($Username, $PostID)
    {
        $sql = "SELECT * FROM saved_posts WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function deleteSavedPost($Username, $PostID)
    {
        $sql = "DELETE FROM saved_posts WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $Username, $PostID);
        $stmt->execute();
    }

    public function insertFollow($FollowedUsername, $FollowerUsername)
    {
        $sql = "INSERT INTO follows (FollowedUsername, FollowerUsername) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $FollowedUsername, $FollowerUsername);
        // if ($stmt->execute() === TRUE) {
        $this->insertNotification(
            "<a href=\"user.php?Username=$FollowerUsername\" class=\"fw-bold\">$FollowerUsername</a> ha iniziato a seguirti.",
            (int)$this->getLastNotificationId()[0] + 1,
            $FollowedUsername,
            date("Y-m-d H:i:s")
        );
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function checkFollow($FollowedUsername, $FollowerUsername)
    {
        $sql = "SELECT * FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $FollowedUsername, $FollowerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function deleteFollow($FollowedUsername, $FollowerUsername)
    {
        $sql = "DELETE FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $FollowedUsername, $FollowerUsername);
        $stmt->execute();
    }

    public function getSavedPostsByUsername($Username)
    {
        $sql = "SELECT * FROM posts WHERE PostID IN (SELECT PostID FROM saved_posts WHERE Username = ?) ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        // if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
        // } else {
        //     return false;
        // }
    }

    // public function ottienicategoriePost($PostID)
    // {
    //     $sql = "SELECT * FROM post_categories WHERE PostID = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("i", $PostID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return false;
    //     }
    // }

    public function getPostsByUsername($Username)
    {
        $sql = "SELECT * FROM posts WHERE Username = ? ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function getPostsForHomeByUsername($Username)
    {
        $sql = "SELECT * FROM posts WHERE Username IN (SELECT FollowedUsername FROM follows WHERE Username = ?) ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function getCommentsByPostId($PostID)
    {
        $sql = "SELECT * FROM comments WHERE PostID = ? ORDER BY DateAndTime ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: perchè return false?
            return false;
        }
    }

    public function getPostsByCategoryIdAndUsername($CategoryID, $Username)
    {
        $sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.PostID IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $CategoryID, $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: perchè return false?
            return false;
        }
    }

    public function getPostsForExploreByUsername($Username)
    {
        $sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: perchè return false?
            return false;
        }
    }

    public function updatePost($PostID, $TextContent)
    {
        $query = "UPDATE posts SET TextContent = ? WHERE PostID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $TextContent, $PostID);
        $stmt->execute();
    }

    public function deleteAllCategoriesFromPost($PostID)
    {
        $sql = "DELETE FROM post_categories WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
    }

    public function deletePostById($PostID)
    {
        $this->deleteAllCategoriesFromPost($PostID);
        $this->deleteAllCommentsFromPost($PostID);
        $this->deleteAllReactionsFromPost($PostID);
        $this->deleteSavedPostById($PostID);
        $sql = "DELETE FROM posts WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
    }

    private function deleteSavedPostById($PostID)
    {
        $sql = "DELETE FROM saved_posts WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
    }

    private function deleteAllCommentsFromPost($PostID)
    {
        $sql = "DELETE FROM comments WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
    }

    public function deleteNotificationById($NotificationID)
    {
        $sql = "DELETE FROM notifications WHERE NotificationID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $NotificationID);
        $stmt->execute();
    }

    public function deleteAllNotificationsByUsername($Username)
    {
        $sql = "DELETE FROM notifications WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
    }

    public function readAllNotificationsByUsername($Username)
    {
        $sql = "UPDATE notifications SET `Read` = '1' WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
    }

    public function getNotificationByUsername($Username)
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

    public function readNotificationById($NotificationID)
    {
        $sql = "UPDATE notifications SET `Read` = '1' WHERE NotificationID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $NotificationID);
        $stmt->execute();
    }

    private function deleteAllReactionsFromPost($PostID)
    {
        $sql = "DELETE FROM post_reactions WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $PostID);
        $stmt->execute();
    }

    public function getAllFollowedByFollowerUsername($FollowerUsername)
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

    public function getAllFollowersByFollowedUsername($FollowedUsername)
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

    public function getLastPostId()
    {
        $sql = "SELECT PostID FROM posts ORDER BY PostID DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return array(0);
        }
    }

    public function getLastCommentIdByPost($PostID)
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

    public function getLastNotificationId()
    {
        $sql = "SELECT NotificationID FROM notifications ORDER BY NotificationID DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return array(0);
        }
    }

    public function getUserByUsername($Username)
    {
        $sql = "SELECT * FROM users WHERE Username = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        // if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
        // } else {
        //     return false;
        // }
    }

    public function getUserByEmail($Email)
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

    // public function ottieniReazione($ReactionID)
    // {
    //     $sql = "SELECT * FROM reactions WHERE ReactionID = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("i", $ReactionID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return false;
    //     }
    // }

    // public function contaPostConReazione($PostID, $ReactionID)
    // {
    //     $sql = "SELECT COUNT(*) FROM post_reactions WHERE PostID = ? AND ReactionID = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("ii", $PostID, $ReactionID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_row();
    //     } else {
    //         return 0;
    //     }
    // }

    public function countPostReactionsByReactionIdAndPostId($ReactionID, $PostID)
    {
        $sql = "SELECT COUNT(*) FROM post_reactions WHERE ReactionID = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $ReactionID, $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countFollowedByFollowerUsername($FollowerUsername)
    {
        $sql = "SELECT COUNT(*) FROM follows WHERE FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $FollowerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countFollowersByFollowedUsername($FollowedUsername)
    {
        $sql = "SELECT COUNT(*) FROM follows WHERE FollowedUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $FollowedUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countNotificationsByUsername($Username)
    {
        $sql = "SELECT COUNT(*) FROM notifications WHERE Username = ? and `Read` = ?";
        $stmt = $this->db->prepare($sql);
        $Read = 0;
        $stmt->bind_param("si", $Username, $Read);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countPostsByUsername($Username)
    {
        $sql = "SELECT COUNT(*) FROM posts WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    // public function ottieniUtenteLoggato($Username, $Password)
    // {
    //     $sql = "SELECT * FROM utente WHERE Username = ? AND Password = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("ss", $Username, $Password);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return false;
    //     }
    // }

    public function getUserLikeUsername($Username)
    {
        $sql = "SELECT Username, Email, FileName, Bio FROM users WHERE Username LIKE ?";
        $stmt = $this->db->prepare($sql);
        $Username = "%" . $Username . "%";
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($Username, $FileName, $Bio)
    {
        $sql = "UPDATE users SET FileName = ? Bio = ? WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $FileName, $Bio, $Username);
        $stmt->execute();
    }


    public function getFileNameByUsername($Username)
    {
        $sql = "SELECT FileName FROM users WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function getAverageReactionByUsername($Username)
    {
        $sql = "SELECT AVG(post_reactions.ReactionID) FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function getPostReactionByPostIdAndUsername($PostID, $Username)
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
