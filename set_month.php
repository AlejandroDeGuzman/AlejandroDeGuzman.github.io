<?php
session_start();

if (isset($_GET['month'])) {
    $month = $_GET['month'];
    $_SESSION['month'] = $month;

    // Redirect to your filtered blog view
    header("Location: viewBlog.php");
    exit();
}
?>
