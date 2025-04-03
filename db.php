<?php

// $user = "root";
// $pass = "root";
// $dbname = "sys";
// $host = "localhost";

class MySQLDatabaseConnection
{
    private $PDOInstance;
    public function __construct($host, $dbname, $user, $pass)
    {
        try {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        } catch (PDOException $e) {
            throw new Exception("Database Connection Error!");
            tryReconnecting();
        }
    }

    public function tryReconnecting($host, $dbname, $user, $pass): void
    {
        try {
            $this->PDOInstance = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            echo "Connection successfull!\n";
        } catch (PDOException $e) {
            echo "Error, cannot connect to database!";
            throw new Exception("Database Connection Error!");
        }
    }

    public function getPDOInstance(): PDO
    {
        return $this->PDOInstance;
    }
}

abstract class MySQLDatabaseModel
{
    protected $DBC;
    public function __construct($DBC)
    {
        $this->DBC = $DBC;
    }
}

class SessionDataManager extends MySQLDatabaseModel
{
    protected $DBC;
    public function __construct($DBC)
    {
        // call super of abstract class
        parent::__construct($DBC);
        
    }

    public function getDBC(): MySQLDatabaseConnection
    {
        return $this->DBC;
    }

    public function addEntry($title, $message, $user_id): void 
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            INSERT INTO BlogPosts (user_id, title, content)
            VALUES (?, ?, ?);
            ");
        $stmt->execute([$user_id, $title, $message]);
    }

    public function login($email, $password): void
    {
        $stmt = $this->getDBC()->getPDOInstance()->prepare("
            SELECT * 
            FROM UserData 
            WHERE email = ?; 
            ");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && $password == $user["password"]) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["id"] = $user["id"];
            $_SESSION["login-success"] = True;
        } 
        else 
        {
            $_SESSION["username"] = "NA";
            $_SESSION["email"] = "NA";
            $_SESSION["id"] = "NA";
            $_SESSION["login-success"] = False;
        } 
    }
}
