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

    <div id="contact-form-div">
        <h3>(blog.)</h3>
        <form>
            <h4>(add a post.)</h4>
            <div>
                <input type="text" id="title" name="title" placeholder="Enter title" required>
                <textarea id="message" name="message" placeholder="Write your text here..." style="height=200px" required></textarea>
                <input type="submit" value="(submit.)">    
                <input type="reset" value="(clear.)">   
            </div>
        </form> 
    </div>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
