<?php
class Database{

    // specify your own database credentials
    private $host = "ID328957_elpanini.db.webhosting.be";
    private $db_name = "ID328957_elpanini";
    private $username = "ID328957_elpanini";
    private $password = "ssselpanini123";
    public $conn;

    // get the database connection
    public function connect(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error could not connect to db: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>