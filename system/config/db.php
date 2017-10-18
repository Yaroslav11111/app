<?php
namespace taskManager\system\config;



class db
{
//PDO
    protected  $db_host = 'localhost';
    protected  $db_database   = 'task';
    protected  $db_user = 'root';
    protected  $db_pass = '';
    protected  $db_charset = 'utf8';
    public  $connect;
    public function __construct (){

        try {
            $dsn = "mysql:host=$this->db_host;dbname=$this->db_database;charset=$this->db_charset";
            $opt = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->connect = new \PDO($dsn, $this->db_user, $this->db_pass, $opt);


        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "ERRORS";
            die();
        }

        return $this->connect;
    }


}
session_start();