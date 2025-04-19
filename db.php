<?php

class MySQLDatabaseConnection
{
    private $mysqli;
    public function __construct($host, $dbname, $user, $pass)
    {
        $this->mysqli = new mysqli($host, $user, $pass, $dbname);

        if ($this->mysqli->connect_error) {
            throw new Exception("Database Connection Error!");
        }
    }

    public function tryReconnecting($host, $dbname, $user, $pass): void
    {
        $this->mysqli = new mysqli($host, $user, $pass, $dbname);

        if ($this->mysqli->connect_error) {
            echo "Error, cannot connect to database!";
            throw new Exception("Database Connection Error!");
        } else {
            echo "Connection successful!\n";
        }
    }

    public function getMySQLiInstance(): mysqli
    {
        return $this->mysqli;
    }
}

abstract class MySQLDatabaseModel
{
    protected $DBC;
    public function __construct($DBC)
    {
        $this->DBC = $DBC;
    }
}

class SessionDataManager extends MySQLDatabaseModel
{
    public function getDBC(): MySQLDatabaseConnection
    {
        return $this->DBC;
    }

    public function deleteAllCommentsFromBlog($blogID): void
    {
        $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
            DELETE FROM Comments 
            WHERE BlogId = ?
        ");
        $stmt->bind_param("i", $blogID);
        $stmt->execute();
    }

    public function deleteBlogPost($blogID): void
    {
        $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
            DELETE FROM BlogPosts 
            WHERE id = ?
        ");
        $stmt->bind_param("i", $blogID);
        $stmt->execute();
    }

    public function deleteSingleComment($commentID): void
    {
        $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
            DELETE FROM Comments 
            WHERE id = ?
        ");
        $stmt->bind_param("i", $commentID);
        $stmt->execute();
    }

    public function showAllComments($blog_id): void
    {
        $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
            SELECT Comments.message, Comments.created_at, UserData.username, Comments.id
            FROM Comments, UserData
            WHERE Comments.BlogId = ?
            AND Comments.UserId = UserData.id
        ");
        $stmt->bind_param("i", $blog_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = array_reverse($result->fetch_all(MYSQLI_ASSOC));

        foreach ($comments as $comment) {
            echo '
            <div class="comment-div">
                <div class="comment-div-title">
                    <p>' . htmlspecialchars($comment["username"]) . '</p>
                    <p class="comment-date">' . htmlspecialchars($comment["created_at"]) . '</p>';

            if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
                echo '<span class="comment-closebtn">&times;</span>';
            }

            echo '</div>
                <p class="blog-content">' . htmlspecialchars($comment["message"]) . '</p>
                    <article class="BlogID">
                            ' . htmlspecialchars($comment["id"]) . '
                    </article>
                </div>';
        }
    }

    public function addComment($user_id, $blog_id, $message): void
    {
        if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] === true) {
            $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
                INSERT INTO Comments (BlogId, UserId, message)
                VALUES (?, ?, ?)
            ");
            $stmt->bind_param("iis", $blog_id, $user_id, $message);
            $stmt->execute();
        }
    }

    public function showAllBlogEntries($stmt): void
    {
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        usort($rows, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blog_id'])) {
            $message = $_POST['message'];
            $blog_id = $_POST['blog_id'];

            if (!empty($message)) {
                $this->addComment($_SESSION["id"], $blog_id, $message);
            }
        }

        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo '
                <div class="blog">
                    <div class="title-date">
                        <h3 class="blog-content">Title: ' . htmlspecialchars($row["title"]) . '</h3> 
                        <p class="blog-content">Author: ' . htmlspecialchars($row["username"]) . '</p>';

                if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
                    echo '<span class="closebtn">&times;</span>';
                }

                echo '</div>
                    <p>Created: ' . htmlspecialchars($row["created_at"]) . '</p>
                    <p class="blog-content">' . htmlspecialchars($row["content"]) . '</p>
                    <article class="BlogID">' . htmlspecialchars($row["id"]) . '</article>
                    <article class="BlogID">' . date('F') . '</article>';

                if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] === true) {
                    echo '
                    <form class="comment-form" method="POST">
                        <input type="hidden" name="blog_id" value="' . htmlspecialchars($row["id"]) . '">
                        <textarea class="comment" name="message" placeholder="Write a comment..." required></textarea>
                        <input type="submit" id="submit" value="(submit.)">    
                    </form>';
                }

                echo '<div class="comments-section">';
                $this->showAllComments($row["id"]);
                echo '</div></div>';
            }
        } else {
            echo "<h3 id='no-posts'>No Posts to be shown!</h3>";
        }
    }

    public function getAllBlogEntries($month): void
    {
        $conn = $this->getDBC()->getMySQLiInstance();

        if ($month != 'All') {
            $stmt = $conn->prepare("
                SELECT title, content, created_at, username, BlogPosts.id, BlogPosts.month_posted
                FROM BlogPosts, UserData
                WHERE BlogPosts.user_id = UserData.id
                AND BlogPosts.month_posted = ?
            ");
            $stmt->bind_param("s", $month);
        } else {
            $stmt = $conn->prepare("
                SELECT title, content, created_at, username, BlogPosts.id, BlogPosts.month_posted
                FROM BlogPosts, UserData
                WHERE BlogPosts.user_id = UserData.id
            ");
        }

        $stmt->execute();
        $this->showAllBlogEntries($stmt);
    }

    public function addEntry($title, $message, $user_id): void
    {
        $month = date('F');
        $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
            INSERT INTO BlogPosts (user_id, title, content, month_posted)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isss", $user_id, $title, $message, $month);
        $stmt->execute();
    }

    public function login($email, $password): void
    {
        $stmt = $this->getDBC()->getMySQLiInstance()->prepare("
            SELECT * 
            FROM UserData 
            WHERE email = ?
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $password == $user["password"]) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["id"] = $user["id"];
            $_SESSION["login-success"] = true;
            $_SESSION["admin"] = false;
        } else {
            $_SESSION["username"] = "NA";
            $_SESSION["email"] = "NA";
            $_SESSION["id"] = "NA";
            $_SESSION["login-success"] = false;
            $_SESSION["admin"] = false;
        }

        if (isset($_SESSION["id"]) && $_SESSION["id"] == "2") {
            $_SESSION["admin"] = true;
        }
    }
}

