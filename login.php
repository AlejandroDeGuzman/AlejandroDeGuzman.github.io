<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- css files for styling -->
        <link href="./assets/css/reset.css" rel="stylesheet">
        <link href="./assets/css/mobile.css" media="screen and (max-width:500px)" rel="stylesheet">
        <link href="./assets/css/tablet.css" media="screen and (min-width:501px) and (max-width:768px)" rel="stylesheet">
        <link href="./assets/css/normal.css" media="screen and (min-width: 769px) and (max-width:1200px)" rel="stylesheet">
        <link href="./assets/css/widescreen.css" media="screen and (min-width:1201px)" rel="stylesheet">

        <!-- for the hamburger icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </head>
    <body>
         <!-- navbar -->
        <nav>
            <label class="logo">(./)</label>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
           <ul>
                <li><a href="index.php#two">about me.</a></li>
                <li><a href="index.php#three">projects.</a></li>
                <li><a href="index.php#four">contact.</a></li>
                <li><a href="login.php#five">links.</a></li>
                <li><a href="index.php#six">education.</a></li>
                <li><a href="login.php">login.</a></li>
                <li><a href="logout.php">logout.</a></li>
                <li><a href="blog.php">blog.</a></li>
            </ul> 
        </nav>

        <section id="login-section">
            <div id="contact-form-div">
                <h3>(login.)</h3>
                <form action="login.php" method="POST">
                    <div>
                        <input type="email" id="email" name="email" placeholder="Your email" required>   
                        <input type="password" id="password" name="password" placeholder="Your password" required>
                        <input type="submit" value="(submit.)">    
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
                echo "<p>Email Entered: $email</p><br>";
                echo "<p>Password Entered: $password</p>";
                $sessionManager->login($email, $password);
            }

           //$sessionManager->getDBC()->getPDOInstance()->query($sql);
        ?>
        </section>

        <footer>
            <section id="five">
                <div class="flex-container">
                    <div id="social-icons-div">
                        <a href="https://www.linkedin.com/in/alejandro-de-guzman/">
                            <img class="social-icon" src="./assets/images/linkedin.png" alt="linkedin icon">
                        </a>
                        <a href="https://www.linkedin.com/in/alejandro-de-guzman/">
                            <img class="social-icon" src="./assets/images/github.png" alt="github icon">
                        </a>
                        <a href="mailto:alejandrodeguzman@proton.me">
                            <img class="social-icon" src="./assets/images/email.png" alt="email icon">
                        </a>   
                    </div>
                    <p>(+447853422545)</p>
                </div>
            </section>
        </footer>
    </body>
</html>
