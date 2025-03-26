<?php
// $user = "root";
// $pass = "root";
// $dbname = "sys";
// $host = "localhost";

class MySQLDatabaseConnection 
{
    private $PDOInstance;
    function __construct($host, $dbname, $user, $pass) 
    {
        try 
        {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        } 
        catch (PDOException $e) 
        {
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
        session_start();
    }

    function getDBC(): MySQLDatabaseConnection 
    {
        return $this->DBC;
    }

    function authenticateLogin($email, $password): bool 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            SELECT password 
            FROM logins 
            WHERE email = ?; 
            ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) 
        {
            echo "<br>valid";
            return $password == $user['password'];
        }
        echo "<br>not valid";
        return false;
    }

    // function tableExists($connection, $dbname, $table): bool
    // {
    //     $statement = $connection->prepare("
    //         SELECT COUNT(*) 
    //         FROM INFORMATION_SCHEMA.TABLES 
    //         WHERE TABLE_SCHEMA = ? 
    //         AND TABLE_NAME = ?
    //     ");
    //     $statement->execute([$dbname, $table]);
    //     return (bool)$statement->fetchColumn();
    // }
    //
    // function createTable($connection, $dbname, $tablename): void
    // {
    //     $statement = $connection->prepare("
    //         CREATE TABLE $tablename (
    //             column1 INT 
    //         )
    //         ");
    //     $statement->execute();
    // }
}
?>
