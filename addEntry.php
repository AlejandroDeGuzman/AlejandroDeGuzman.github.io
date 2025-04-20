<?php
    require __DIR__ . '/includes/head.php'; 
?>
<section id="blog-section">
    <?php
        if (!isset($_SESSION["login-success"])) {
                header("Location: login.php");
        }
    ?>
    <div class="alert" id="login-success">
        <span class="closebtn">&times;</span> 
        <div>
            <?php
            // Echo session variables that were set on previous page
            if (isset($_SESSION["username"])) {
                echo "<p>Welcome " . $_SESSION["username"] . "!</p>";
            }
            ?>
            <p><strong>Success!</strong> Successfully logged in.</p>
        </div>
    </div>
    <?php
        require 'db.php';
        // setup the database stuff...
        $host = "localhost";
        $dbname = "sys";
        $user = "root";
        $pass = "root";
        $DBC = new MySQLDatabaseConnection($host, $dbname, $user, $pass);
        $sessionManager = new SessionDataManager($DBC);

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $title = $_POST['title'] ?? '';
            $message = $_POST['message'] ?? '';
            $user_id = $_SESSION['id'] ?? null;
            if (!empty($_POST))
            {
                $_SESSION['blog_post_data'] = [
                    'title' => $title,
                    'message' => $message,
                    'user_id' => $user_id
                ];
                $_SESSION["added_blog"] = true;
                header("Location: addPost.php");
            } 
        }
        
        if (isset($_SESSION["added_blog"]) && $_SESSION["added_blog"] === true) {
            echo '<div class="alert" id="added-blog"><span class="closebtn">&times;</span><p>Added blog!</p></div>';
        }

        if (isset($_SESSION["admin"]) && $_SESSION["admin"] === True)
        {
            echo '<p>Admin!</p>';
        }
        else
        {
            echo '<p>Not an admin!</p>';
        }
    ?>
    <div id="contact-form-div">
        <h3>(post.)</h3>
        <form id="postForm" method="POST">
            <h4>(add a post.)</h4>
            <div>
                <input type="text" id="title" name="title" placeholder="Enter title" required>
                <textarea id="message" name="message" placeholder="Write your text here..." required></textarea>
                <input type="submit" id="submit" value="(submit.)">    
                <input type="reset" value="(clear.)">   
            </div>
        </form> 
    </div>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
