<?php
    require __DIR__ . '/includes/head.php'; 
    if (!isset($_SESSION["month"])) 
    {
        $_SESSION["month"] = "All";
    }
?>
<section id="blog-section">
    <h3>(blog.)</h3>
    <div class="dropdown">
        <?php
            echo '<button class="dropbtn">(filter by ' . $_SESSION["month"] . '.)</button>';
        ?>
        <div class="dropdown-content">
            <a href="set_month.php?month=All">All</a>
            <a href="set_month.php?month=January">January</a>
            <a href="set_month.php?month=February">February</a>
            <a href="set_month.php?month=March">March</a>
            <a href="set_month.php?month=April">April</a>
            <a href="set_month.php?month=May">May</a>
            <a href="set_month.php?month=June">June</a>
            <a href="set_month.php?month=July">July</a>
            <a href="set_month.php?month=August">August</a>
            <a href="set_month.php?month=September">September</a>
            <a href="set_month.php?month=October">October</a>
            <a href="set_month.php?month=November">November</a>
            <a href="set_month.php?month=December">December</a>
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
    $sessionManager->getAllBlogEntries($_SESSION["month"]);
    ?>
</section>
<?php 
    require __DIR__ . '/includes/footer.php'; 
?>
