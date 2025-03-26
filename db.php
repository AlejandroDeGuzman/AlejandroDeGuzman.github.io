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

    function login($email, $password): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            SELECT * 
            FROM UserData 
            WHERE email = ?; 
            ");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) 
        {
            if ($password == $user['password'])
            {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $username = $user['username'];
                echo "<br><p>Valid Login, Welcome $username!</p>";
            }
            
        }
        else 
        {
            echo "<br><p>Not a Valid Login</p>";
        }
    }
}
?>
