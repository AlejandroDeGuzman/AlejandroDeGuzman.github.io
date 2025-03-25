<?php
$user = "root";
$pass = "root";
$dbname = "sys";
$host = "localhost";
try {
    $databaseConnection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    echo "Connection successfull!\n";
} catch (PDOException $e) {
    echo "Error, cannot connect to database!";
    // attempt to retry the connection after some timeout for example
}

if ($databaseConnection) {
    $tableName = "test";
    $sql = "SELECT TABLE_NAME
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE TABLE_SCHEMA = 'sys'
            AND TABLE_NAME = '$tableName'";
    $result = $databaseConnection->query($sql);
    // if ($result->num_rows > 0) {
    //     echo "Table ($tableName) exists in the local database called $dbname!";
    // } else {
    //     echo "Does not exist!";
    // }
    // echo "Dean";
}
?>
