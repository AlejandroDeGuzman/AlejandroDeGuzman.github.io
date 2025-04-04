<?php
    require __DIR__ . '/includes/head.php'; 
?>
<section id="blog-section">
    <h3>(blog.)</h3>
    <?php
    require 'db.php';
    // setup the database stuff...
    $host = "localhost";
    $dbname = "sys";
    $user = "root";
    $pass = "root";
    $DBC = new MySQLDatabaseConnection($host, $dbname, $user, $pass);
    $sessionManager = new SessionDataManager($DBC);
    $sessionManager->getAllBlogEntries();
    ?>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
