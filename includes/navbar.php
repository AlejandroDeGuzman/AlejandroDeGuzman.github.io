<!-- navbar -->
<header>
    <nav>
        <label class="logo">(./)</label>
        <?php
            // Echo session variables that were set on previous page
            if (isset($_SESSION["username"]) && $_SESSION["authenticated"] == true) {
                echo '<p id="hello-message">Hello ' . $_SESSION["username"] . '</p>';
            }
        ?>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><a href="index.php#two">about me.</a></li>
            <li><a href="index.php#three">projects.</a></li>
            <li><a href="index.php#four">contact.</a></li>
            <li><a href="index.php#five">links.</a></li>
            <li><a href="index.php#six">education.</a></li>
            <li><a href="login.php">login.</a></li>
            <li><a href="logout.php">logout.</a></li>
            <li><a href="blog.php">blog.</a></li>
        </ul> 
    </nav>
</header>
