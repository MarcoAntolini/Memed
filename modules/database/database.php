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

    public function insertUser($username, $email, $password, $passwordSalt)
    {
        $sql = "INSERT INTO users (Username, Email, Password, PasswordSalt, FileName, Bio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $fileName = 'default-pic.png';
        $bio = '';
        $stmt->bind_param("ssssss", $username, $email, $password, $passwordSalt, $fileName, $bio);
        $stmt->execute();
    }

    public function insertPost($postId, $fileName, $textContent, $dateAndTime, $username)
    {
        $sql = "INSERT INTO posts (PostID, FileName, TextContent, DateAndTime, Username) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("issss", $postId, $fileName, $textContent, $dateAndTime, $username);
        $stmt->execute();
    }

    public function getPostById($postId)
    {
        $sql = "SELECT * FROM posts WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function insertComment($commentId, $textContent, $dateAndTime, $username, $postId)
    {
        $sql = "INSERT INTO comments (PostID, Username, CommentID, TextContent, DateAndTime) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isiss", $postId, $username, $commentId, $textContent, $dateAndTime);
        $stmt->execute();
        // if ($stmt->execute() === TRUE) {
        $post = $this->getPostById($postId);
        $this->insertNotification(
            "<a href=\"user.php?Username=$username\" class=\"fw-bold\">$username</a> ha commentato un tuo post.",
            (int)$this->getLastNotificationId()[0] + 1,
            $post[4],
            $dateAndTime
        );
        // return true;
        // } else {
        // return false;
        // }
    }

    public function insertPostCategory($categoryId, $postId)
    {
        $sql = "INSERT INTO post_categories (PostID, CategoryID) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $postId, $categoryId);
        $stmt->execute();
    }

    // public function inserisciCategoria($Name, $categoryId)
    // {
    //     $sql = "INSERT INTO categories (CategoryID, Name) VALUES (?, ?)";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("is", $categoryId, $Name);
    //     $stmt->execute();
    // }

    public function insertNotification($messaggio, $notificationId, $username, $dateAndTime)
    {
        $sql =  "INSERT INTO notifications (Username, NotificationID, Message, DateAndTime, `Read`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $read = 0;
        $stmt->bind_param("sissi", $username, $notificationId, $messaggio, $dateAndTime, $read);
        $stmt->execute();
    }

    private function deleteReactionOfUserFromPost($username, $postId)
    {
        $sql = "DELETE FROM post_reactions WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $username, $postId);
        $stmt->execute();
    }

    private function checkReaction($username, $postId, $reactionId)
    {
        $sql = "SELECT * FROM post_reactions WHERE Username = ? AND PostID = ? AND ReactionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sii", $username, $postId, $reactionId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function insertReactionOfPost($username, $postId, $reactionId)
    {
        if ($this->checkReaction($username, $postId, $reactionId)) {
            $this->deleteReactionOfUserFromPost($username, $postId);
            return true;
        }
        $this->deleteReactionOfUserFromPost($username, $postId);
        $sql = "INSERT INTO post_reactions (ReactionID, Username, PostID) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isi", $reactionId, $username, $postId);
        $stmt->execute();
    }

    public function insertSavedPost($username, $postId)
    {
        $sql = "INSERT INTO saved_posts (PostID, Username) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        $stmt->execute();
    }

    public function checkSavedPost($username, $postId)
    {
        $sql = "SELECT * FROM saved_posts WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $username, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function deleteSavedPost($username, $postId)
    {
        $sql = "DELETE FROM saved_posts WHERE Username = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $username, $postId);
        $stmt->execute();
    }

    public function insertFollow($followedUsername, $followerUsername)
    {
        $sql = "INSERT INTO follows (FollowedUsername, FollowerUsername) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $followedUsername, $followerUsername);
        $stmt->execute();
        // if ($stmt->execute() === TRUE) {
        $this->insertNotification(
            "<a href=\"user.php?Username=$followerUsername\" class=\"fw-bold\">$followerUsername</a> ha iniziato a seguirti.",
            (int)$this->getLastNotificationId()[0] + 1,
            $followedUsername,
            date("Y-m-d H:i:s")
        );
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function checkFollow($followedUsername, $followerUsername)
    {
        $sql = "SELECT * FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $followedUsername, $followerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function deleteFollow($followedUsername, $followerUsername)
    {
        $sql = "DELETE FROM follows WHERE FollowedUsername = ? AND FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $followedUsername, $followerUsername);
        $stmt->execute();
    }

    public function getSavedPostsByUsername($username)
    {
        $sql = "SELECT * FROM posts WHERE PostID IN (SELECT PostID FROM saved_posts WHERE Username = ?) ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
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

    // public function ottienicategoriePost($postId)
    // {
    //     $sql = "SELECT * FROM post_categories WHERE PostID = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("i", $postId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return false;
    //     }
    // }

    public function getPostsByUsername($username)
    {
        $sql = "SELECT * FROM posts WHERE Username = ? ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function getPostsForHomeByUsername($username)
    {
        $sql = "SELECT * FROM posts WHERE Username IN (SELECT FollowedUsername FROM follows WHERE Username = ?) ORDER BY DateAndTime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: return false?
            return false;
        }
    }

    public function getCommentsByPostId($postId)
    {
        $sql = "SELECT * FROM comments WHERE PostID = ? ORDER BY DateAndTime ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: perchè return false?
            return false;
        }
    }

    public function getPostsByCategoryIdAndUsername($categoryId, $username)
    {
        $sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.PostID IN (SELECT PostID FROM post_categories WHERE CategoryID = ?) AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $categoryId, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: perchè return false?
            return false;
        }
    }

    public function getPostsForExploreByUsername($username)
    {
        $sql = "SELECT posts.* FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username != ? GROUP BY posts.PostID ORDER BY AVG(post_reactions.ReactionID) DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // TODO: perchè return false?
            return false;
        }
    }

    public function updatePost($postId, $textContent)
    {
        $query = "UPDATE posts SET TextContent = ? WHERE PostID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $textContent, $postId);
        $stmt->execute();
    }

    public function deleteAllCategoriesFromPost($postId)
    {
        $sql = "DELETE FROM post_categories WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }

    public function deletePostById($postId)
    {
        $this->deleteAllCategoriesFromPost($postId);
        $this->deleteAllCommentsFromPost($postId);
        $this->deleteAllReactionsFromPost($postId);
        $this->deleteSavedPostById($postId);
        $sql = "DELETE FROM posts WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }

    private function deleteSavedPostById($postId)
    {
        $sql = "DELETE FROM saved_posts WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }

    private function deleteAllCommentsFromPost($postId)
    {
        $sql = "DELETE FROM comments WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }

    public function deleteNotificationById($notificationId)
    {
        $sql = "DELETE FROM notifications WHERE NotificationID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $notificationId);
        $stmt->execute();
    }

    public function deleteAllNotificationsByUsername($username)
    {
        $sql = "DELETE FROM notifications WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    }

    public function readAllNotificationsByUsername($username)
    {
        $sql = "UPDATE notifications SET `Read` = '1' WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    }

    public function getNotificationByUsername($username)
    {
        $sql = "SELECT * FROM notifications WHERE Username = ? ORDER BY DateAndTime DESC";
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

    public function readNotificationById($notificationId)
    {
        $sql = "UPDATE notifications SET `Read` = '1' WHERE NotificationID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $notificationId);
        $stmt->execute();
    }

    private function deleteAllReactionsFromPost($postId)
    {
        $sql = "DELETE FROM post_reactions WHERE PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }

    public function getAllFollowedByFollowerUsername($followerUsername)
    {
        $sql = "SELECT FollowedUsername FROM follows WHERE FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $followerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function getAllFollowersByFollowedUsername($followedUsername)
    {
        $sql = "SELECT FollowerUsername FROM follows WHERE FollowedUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $followedUsername);
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

    public function getLastCommentIdByPost($postId)
    {
        $sql = "SELECT CommentID FROM comments WHERE PostID = ? ORDER BY CommentID DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
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

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE Username = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        // if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
        // } else {
        //     return false;
        // }
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE Email = ? LIMIT 1";
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

    // public function ottieniReazione($reactionId)
    // {
    //     $sql = "SELECT * FROM reactions WHERE ReactionID = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("i", $reactionId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return false;
    //     }
    // }

    // public function contaPostConReazione($postId, $reactionId)
    // {
    //     $sql = "SELECT COUNT(*) FROM post_reactions WHERE PostID = ? AND ReactionID = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("ii", $postId, $reactionId);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_row();
    //     } else {
    //         return 0;
    //     }
    // }

    public function countPostReactionsByReactionIdAndPostId($reactionId, $postId)
    {
        $sql = "SELECT COUNT(*) FROM post_reactions WHERE ReactionID = ? AND PostID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $reactionId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countFollowedByFollowerUsername($followerUsername)
    {
        $sql = "SELECT COUNT(*) FROM follows WHERE FollowerUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $followerUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countFollowersByFollowedUsername($followedUsername)
    {
        $sql = "SELECT COUNT(*) FROM follows WHERE FollowedUsername = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $followedUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countNotificationsByUsername($username)
    {
        $sql = "SELECT COUNT(*) FROM notifications WHERE Username = ? and `Read` = ?";
        $stmt = $this->db->prepare($sql);
        $read = 0;
        $stmt->bind_param("si", $username, $read);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    public function countPostsByUsername($username)
    {
        $sql = "SELECT COUNT(*) FROM posts WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }

    // public function ottieniUtenteLoggato($username, $password)
    // {
    //     $sql = "SELECT * FROM utente WHERE Username = ? AND Password = ?";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("ss", $username, $password);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } else {
    //         return false;
    //     }
    // }

    public function getUserLikeUsername($username)
    {
        $sql = "SELECT Username, Email, FileName, Bio FROM users WHERE Username LIKE ?";
        $stmt = $this->db->prepare($sql);
        $username = "%" . $username . "%";
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($username, $fileName, $bio)
    {
        $sql = "UPDATE users SET FileName = ? Bio = ? WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $fileName, $bio, $username);
        $stmt->execute();
    }


    public function getFileNameByUsername($username)
    {
        $sql = "SELECT FileName FROM users WHERE Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function getAverageReactionByUsername($username)
    {
        $sql = "SELECT AVG(post_reactions.ReactionID) FROM posts, post_reactions WHERE posts.PostID=post_reactions.PostID AND posts.Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_row();
    }

    public function getPostReactionByPostIdAndUsername($postId, $username)
    {
        $sql = "SELECT ReactionID FROM post_reactions WHERE PostID = ? AND Username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result == null) {
            return 0;
        } elseif ($result->num_rows > 0) {
            return $result->fetch_row();
        } else {
            return 0;
        }
    }
}
