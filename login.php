<?php
    require __DIR__ . '/includes/head.php'; 
?>
<section id="login-section">
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
        if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] === True)
        {
            header('Location: addPost.php');
            exit();
        }
        else if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] === False)
        {
           echo '<div class="alert" id="login-fail">
               <span class="closebtn">&times;</span> 
               <p><strong>Fail!</strong> Invalid details, please try again.</p>
               </div>';
        }

        if (isset($_SESSION["id"]) && $_SESSION["id"] == "1")
        {
            echo '<p>Admin!</p>';
        }
    }
?>
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
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
