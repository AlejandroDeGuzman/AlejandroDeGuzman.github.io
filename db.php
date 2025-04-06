<?php

// $user = "root";
// $pass = "root";
// $dbname = "sys";
// $host = "localhost";

class MySQLDatabaseConnection
{
    private $PDOInstance;
    public function __construct($host, $dbname, $user, $pass)
    {
        try {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        } catch (PDOException $e) {
            throw new Exception("Database Connection Error!");
            tryReconnecting();
        }
    }

    public function tryReconnecting($host, $dbname, $user, $pass): void
    {
        try {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            echo "Connection successfull!\n";
        } catch (PDOException $e) {
            echo "Error, cannot connect to database!";
            throw new Exception("Database Connection Error!");
        }
    }

    public function getPDOInstance(): PDO
    {
        return $this->PDOInstance;
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
    protected $DBC;
    public function __construct($DBC)
    {
        // call super of abstract class
        parent::__construct($DBC);
        
    }

    public function getDBC(): MySQLDatabaseConnection
    {
        return $this->DBC;
    }

    public function deleteAllCommentsFromBlog($blogID): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            DELETE FROM Comments 
            WHERE BlogId = ?; 
            ");
        $stmt->execute([$blogID]);
    }

    public function deleteBlogPost($blogID): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            DELETE FROM BlogPosts
            WHERE id = ?; 
            ");
        $stmt->execute([$blogID]);
    }

    public function deleteSingleComment($commentID): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            DELETE FROM Comments 
            WHERE id = ?; 
            ");
        $stmt->execute([$commentID]);
    }

    public function showAllComments($blog_id): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            SELECT Comments.message, Comments.created_at, UserData.username, Comments.id
            FROM Comments, UserData
            WHERE Comments.BlogId = ?
            AND Comments.UserId = UserData.id
            ");
        $stmt->execute([$blog_id]);   

        $comments = $stmt->fetchAll();
        foreach ($comments as $comment) 
        {
            echo '
            <div class="comment-div">
                <div class="comment-div-title">
                    <p>' . htmlspecialchars($comment["username"]) . '</p>
                <p class="comment-date">' . htmlspecialchars($comment["created_at"]) . '</p>';

            if (isset($_SESSION["admin"]) && $_SESSION["admin"] === True) {
                echo '<span class="comment-closebtn">&times;</span>';
            }
            echo '</div>
                <p class="blog-content">' . htmlspecialchars($comment["message"]) . '</p>
                <article class="BlogID">
                        ' . htmlspecialchars($comment["id"]) . '
                </article>
                </div>
            ';

        }
    }

    public function addComment($user_id, $blog_id, $message): void
    {
        if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] === True)
        {
            $stmt = $this->getDBC()->getPDOInstance()->prepare("
            INSERT INTO Comments (BlogId, UserId, message)
            VALUES (?, ?, ?);
            ");
            $stmt->execute([$blog_id, $user_id, $message]);
        }
    }

    public function showAllBlogEntries($stmt): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blog_id'])) 
        {
            $message = $_POST['message'];
            $blog_id = $_POST['blog_id'];

            if (!empty($message))
            {
                $this->addComment($_SESSION["id"], $blog_id, $message);
            }
        }

        $rows = array_reverse($stmt->fetchAll());
        foreach ($rows as $row) 
        {

            echo '
                <div class="blog">
                    <div class="title-date">
                        <h3 class="blog-content">Title: ' . htmlspecialchars($row["title"]) . '</h3> 
                        <p class="blog-content">Author: ' . htmlspecialchars($row["username"]) . '</p>';

                if (isset($_SESSION["admin"]) && $_SESSION["admin"] === True) {
                    echo '<span class="closebtn">&times;</span>';
                }

            echo '</div>
                    <p>Created: ' . htmlspecialchars($row["created_at"]) . '</p>
                    <p class="blog-content">' . htmlspecialchars($row["content"]) . '</p>
                    <article class="BlogID">
                        ' . htmlspecialchars($row["id"]) . '
                    </article>
                ';

            if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] === True)
            {
                echo '
                <form class="comment-form" method="POST">
                    <input type="hidden" name="blog_id" value="' . htmlspecialchars($row["id"]) . '">
                    <textarea class="comment" name="message" type="text" placeholder="Write a comment..." required></textarea>
                    <input type="submit" id="submit" value="(submit.)">    
                </form>
                ';
            }

            echo '<div class="comments-section">';
                $this->showAllComments($row["id"]);
            echo '</div>';

            echo '</div>';
            
        }
    }

    public function getAllBlogEntries(): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            SELECT title, content, created_at, username, BlogPosts.id
            FROM BlogPosts, UserData
            WHERE BlogPosts.user_id = UserData.id;
            ");
        $stmt->execute();
        $this->showAllBlogEntries($stmt);
    }

    public function addEntry($title, $message, $user_id): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            INSERT INTO BlogPosts (user_id, title, content)
            VALUES (?, ?, ?);
            ");
        $stmt->execute([$user_id, $title, $message]);
    }

    public function login($email, $password): void
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            SELECT * 
            FROM UserData 
            WHERE email = ?; 
            ");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && $password == $user["password"]) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["id"] = $user["id"];
            $_SESSION["login-success"] = True;
            $_SESSION["admin"] = False;
        } 
        else 
        {
            $_SESSION["username"] = "NA";
            $_SESSION["email"] = "NA";
            $_SESSION["id"] = "NA";
            $_SESSION["login-success"] = False;
            $_SESSION["admin"] = False;
        } 

        // check for admin
        if (isset($_SESSION["admin"]) && $_SESSION["id"] == "2")
        {
            $_SESSION["admin"] = True;
        }
    }
}
