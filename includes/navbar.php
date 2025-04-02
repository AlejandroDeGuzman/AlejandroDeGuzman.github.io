<!-- navbar -->
<header>
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
            <li><a href="index.php#five">links.</a></li>
            <li><a href="index.php#six">education.</a></li>
            <?php
            if (isset($_SESSION["login-success"]) && $_SESSION["login-success"] == true)
            {
                echo '<li><a href="logout.php">logout.</a></li>';
                echo '<li><a href="addPost.php">post.</a></li>';
            }
            else 
            {
                echo '<li><a href="login.php">login.</a></li>';
            }
            ?>
            <li><a href="viewBlog.php">blog.</a></li>
        </ul> 
    </nav>
</header>
