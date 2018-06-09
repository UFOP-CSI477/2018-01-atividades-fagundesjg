<?php

namespace model;
use PDO;

class Database
{
    protected $host = "localhost";
    protected $user = "sysanalyses";
    protected $pass = "123456";
    protected $dbname = "analyses";
    protected $db = null;

    //construtor da classe
    protected function __construct()
    {

    }

    //singleton instance static
    public static function getInstance()
    {

        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    public function getDB()
    {
        if ($this->db === null)
        {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->db = new PDO($dsn, $this->user, $this->pass);
        }

        return $this->db;
    }

}

?>
