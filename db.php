<?php
$user = "root";
$pass = "root";
$dbname = "sys";
$host = "localhost";

class MySQLDatabaseConnection 
{
    private $PDOInstance;
    function __construct($host, $dbname, $user, $pass) 
    {
        try 
        {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            echo "Connection successfull!\n";
        } 
        catch (PDOException $e) 
        {
            echo "Error, cannot connect to database!";
            throw new Exception("Database Connection Error!");
            tryReconnecting();
        }
    }

    function tryReconnecting($host, $dbname, $user, $pass): void 
    {
        try 
        {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            echo "Connection successfull!\n";
        } 
        catch (PDOException $e) 
        {
            echo "Error, cannot connect to database!";
            throw new Exception("Database Connection Error!");
        }
    }

    function getPDOInstance(): PDO 
    {
        return $this->PDOInstance; 
    }
}

abstract class MySQLDatabaseModel 
{
    protected $DBC;
    function __construct($DBC)
    {
        $this->DBC = $DBC;
    }
}

class SessionDataManager extends MySQLDatabaseModel
{
    protected $DBC;
    function __construct($DBC)
    {
        // call super of abstract class
        parent::__construct($DBC);
    }

    function tableExists($connection, $dbname, $table): bool
    {
        $statement = $connection->prepare("
            SELECT COUNT(*) 
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE TABLE_SCHEMA = ? 
            AND TABLE_NAME = ?
        ");
        $statement->execute([$dbname, $table]);
        return (bool)$statement->fetchColumn();
    }

    function createTable($connection, $dbname, $tablename): void
    {
        $statement = $connection->prepare("
            CREATE TABLE $tablename (
                column1 INT 
            )
            ");
        $statement->execute();
    }
}

try {
    $databaseConnection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    echo "Connection successfull!\n";
    $table = "logins";
    if (tableExists($databaseConnection, $dbname, $table)) {
        echo "Table Exists!";
    } else {
        $sqlQuery = "
        CREATE TABLE $table (
            id INT NOT NULL AUTO_INCREMENT,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            PRIMARY KEY ( id )
        )
        ";
        $databaseConnection->exec($sqlQuery);
        // createTable($databaseConnection, $dbname, $table);
        echo "Table does not exist!";
    }
} catch (PDOException $e) {
    echo "Error, cannot connect to database!";
    // attempt to retry the connection after some timeout for example
}
?>
