<?php

namespace classes;

use PDO;
use PDOException;

class DBConnector{
    private static $hostname = "localhost";
    private static $dbname = "melomaniac";
    private static $username = "root";
    private static $password = "";

    public static function getConnection(){
        try{
            $dsn = "mysql:host=".DBConnector::$hostname.";dbname=".DBConnector::$dbname;
            $con = new PDO($dsn, DBConnector::$username, DBConnector::$password);
            return $con;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}