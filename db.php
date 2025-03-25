<?php
$user = "root";
$pass = "root";
$dbname = "sys";
$host = "localhost";

function tableExists($connection, $dbname, $table) {
    $statement = $connection->prepare("
        SELECT COUNT(*) 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = ? 
        AND TABLE_NAME = ?
    ");
    $statement->execute([$dbname, $table]);
    return (bool)$statement->fetchColumn();
}

function createTable($connection, $dbname, $tablename) {
    $statement = $connection->prepare("
        CREATE TABLE $tablename (
            column1 INT 
        )
        ");
    $statement->execute();
}

try {
    $databaseConnection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    echo "Connection successfull!\n";
    $table = "test";
    if (tableExists($databaseConnection, $dbname, $table)) {
        echo "Table Exists!";
    } else {
        createTable($databaseConnection, $dbname, $table);
        echo "Table does not exist!";
    }
} catch (PDOException $e) {
    echo "Error, cannot connect to database!";
    // attempt to retry the connection after some timeout for example
}
?>
