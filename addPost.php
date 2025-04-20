<?php
session_start();
header("Location: addEntry.php");
require 'db.php';
// setup the database stuff...
$host = "localhost";
$dbname = "sys";
$user = "root";
$pass = "root";
$DBC = new MySQLDatabaseConnection($host, $dbname, $user, $pass);
$sessionManager = new SessionDataManager($DBC);
if (isset($_SESSION["blog_post_data"])) {
    $title = $_SESSION["blog_post_data"]['title'];
    $message = $_SESSION["blog_post_data"]['message'];
    $user_id = $_SESSION["blog_post_data"]['user_id'];
    $sessionManager->addEntry($title, $message, $user_id);
}
?>
