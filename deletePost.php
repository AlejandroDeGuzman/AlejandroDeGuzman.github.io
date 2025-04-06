<?php
require 'db.php';
// setup the database stuff...
$host = "localhost";
$dbname = "sys";
$user = "root";
$pass = "root";
$DBC = new MySQLDatabaseConnection($host, $dbname, $user, $pass);
$sessionManager = new SessionDataManager($DBC);
$data = json_decode(file_get_contents('php://input'), true);

$sessionManager->deleteBlogPost($data['id']);
?>


