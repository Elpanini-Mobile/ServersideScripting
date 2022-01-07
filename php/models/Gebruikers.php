<?php
class Gebruikers{

    // database connection and table name
    private $conn;
    private $table = 'gebruikers';

    // object properties
    public $id;
    public $username;
    public $password;
    public $email;


    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // read gebruikers
    public function read(){
    //select all query
       $query =
       'SELECT id, username, password, email
        FROM ' . $this->table . '';

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
    }

public function readOne(){

    // read single record
    $query = 'SELECT
          id,
          username,
          password,
          email
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind id of gebruikers to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->id = $row['id'];
    $this->username = $row['username'];
    $this->password = $row['password'];
    $this->email = $row['email'];
    }

    // create gebruikers
    public function create() {

    // query to insert record
    $query = 'INSERT INTO ' . $this->table . ' SET username = :username, password = :password, email = :email';

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->email = htmlspecialchars(strip_tags($this->email));

    // bind values
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':email', $this->email);

    // execute query
    if($stmt->execute()) {
        return true;
    }
      // error
      printf("Error: ", $stmt->error);

    return false;
    }

    // update the gebruiker
    public function update(){

    // update query
    $query = 'UPDATE
                ' . $this->table . '
            SET
            username= :username,
            password= :password,
            email= :email
            WHERE
            id = :id';

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // bind values
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }

      // error
      printf("Error: ", $stmt->error);
    return false;
}

// delete the gebruikers
public function delete(){

    // delete query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // prepare query
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    // bind id of record to delete
    $stmt-> bindParam(':id', $this->id);

    // execute query
    if($stmt->execute()){
        return true;
    }

      // error
      printf("Error: ", $stmt->error);
    return false;
}

// login
public function login(){
    // query to read single record
    $query = 'SELECT id, username, password, email
               FROM gebruikers
              WHERE email = ? and password = ?
              LIMIT 0,1';

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // bind email and password of gebruikers to be searched
    $stmt->bindParam(1, $this->email);
    $stmt->bindParam(2, $this->password);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->id = $row['id'];
    $this->username = $row['username'];
}
}