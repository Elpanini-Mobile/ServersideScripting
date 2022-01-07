<?php
  class Broodjes {

    // DB
    private $conn;
    private $table = 'broodjes';

    // Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $description;
    public $foto;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get broodjes
    public function read() {
      // Create query
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.price, p.description, p.foto
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                categorieen c ON p.category_id = c.id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get one broodje
    public function readOne() {
          // Create query
          $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.price, p.description, p.foto
          FROM ' . $this->table . ' p
                                    LEFT JOIN
                                    categorieen c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->title = $row['title'];
          $this->price = $row['price'];
          $this->description = $row['description'];
          $this->foto = $row['foto'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];
    }

    // Create broodje
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, price = :price, description = :description, foto = :foto, category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->price = htmlspecialchars(strip_tags($this->price));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->foto = htmlspecialchars(strip_tags($this->foto));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':price', $this->price);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':foto', $this->foto);
          $stmt->bindParam(':category_id', $this->category_id);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // error
      printf("Error: ", $stmt->error);

      return false;
    }

    // Update broodje
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET title = :title, price = :price, description = :description, foto = :foto, category_id = :category_id
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->price = htmlspecialchars(strip_tags($this->price));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->foto = htmlspecialchars(strip_tags($this->foto));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':price', $this->price);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':foto', $this->foto);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

      // error
      printf("Error: ", $stmt->error);

          return false;
    }

    // Delete broodje
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

      // error
      printf("Error: ", $stmt->error);

          return false;
    }

  }