<?php
    require __DIR__ . '/includes/head.php'; 
?>
<section id="login-section">

    <div class="alert" id="login-fail">
        <span class="closebtn">&times;</span> 
        <p><strong>Fail!</strong> Invalid details, please try again.</p>
    </div>

    <div id="contact-form-div">
        <h3>(login.)</h3>
        <form action="login.php" method="POST">
            <div>
                <input type="email" id="email" name="email" placeholder="Your email" required>   
                <input type="password" id="password" name="password" placeholder="Your password" required>
                <input type="submit" id="submit" value="(submit.)">    
            </div>
        </form> 
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
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sessionManager->login($email, $password);
        if (isset($_SESSION["login-success"]) && $_SESSION["login-success"])
        {
            //echo "<br><p>Welcome " . $_SESSION["username"] . "!</p>";
             header('Location: addPost.php');
        }
       
    echo '<div id="user-data">
        <p>' . htmlspecialchars($_SESSION['username'] ?? 'NA') . '</p>
        <p>' . htmlspecialchars($_SESSION['login-success'] ?? 'NA') . '</p>
        </div>';
        echo '<script src="./assets/js/alert.js"></script>';
        echo "<script>alertplace();</script>";
    }
?>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
