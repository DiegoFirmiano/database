<?php

class Connection
{

    private static string   $driver = "mysql";
    private static ?string  $dsn = null;
    private static string   $host = "localhost";
    private static string   $db = "test";
    private static string   $user = "root";
    private static string   $password = "";
    private static array    $options = [\PDO::MYSQL_ATTR_INIT_COMMAND =>" SET NAMES utf8mb4"];
    private static ?object  $connection = null;


    /**
     * @return array|object|PDO|null
     */
    private static function setConnection()
    {
        try{
            if(is_null(self::$connection)){
                self::$dsn = self::$driver.":host=".self::$host.";dbname=".self::$db;
                self::$connection = new \PDO(self::$dsn, self::$user, self::$password, self::$options);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }catch(\PDOException $error){
           return  DatabaseException::dbException($error);
        }
        return self::$connection;
    }

    /**
     * @return array|object|PDO|null
     */
    public static function getConnection(){
        return self::setConnection();
    }
}