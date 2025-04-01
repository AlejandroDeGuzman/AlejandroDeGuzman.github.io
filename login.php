<?php
    require __DIR__ . '/includes/head.php'; 
?>
<section id="login-section">

    <div class="alert" id="login-success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <p><strong>Success!</strong> Successfully logged in.</p>
    </div>

    <div id="contact-form-div">
        <h3>(login.)</h3>
        <form action="login.php" method="POST">
            <div>
                <input type="email" id="email" name="email" placeholder="Your email" required>   
                <input type="password" id="password" name="password" placeholder="Your password" required>
                <input type="submit" value="(submit.)" onclick="alertplace()">    
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
        // echo "<p>Email Entered: $email</p><br>";
        // echo "<p>Password Entered: $password</p>";
        $sessionManager->login($email, $password);
       
    echo '<div id="user-data">
        <p>' . htmlspecialchars($_SESSION['username'] ?? 'NA') . '</p>
        <p id="login-success">' . htmlspecialchars($_SESSION['login-success'] ?? 'NA') . '</p>
        </div>';
        echo '<script src="./assets/js/alert.js"></script>';
        echo "<script>alertplace();</script>";
    }

    //$sessionManager->getDBC()->getPDOInstance()->query($sql);
?>
    
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
