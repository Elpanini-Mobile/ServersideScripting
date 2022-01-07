<?php
  class Category {
    // DB
    private $conn;
    private $table = 'categorieen';

    // Properties
    public $id;
    public $name;
    public $selected;
    public $foto;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categorieen
    public function read() {
      $query = 'SELECT
        id,
        name,
        selected,
        foto
      FROM
        ' . $this->table . '';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get one Category
  public function readOne(){
    // Create query
    $query = 'SELECT
          id,
          name,
          selected,
          foto
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->selected = $row['selected'];
      $this->foto = $row['foto'];
  }

  public function readName(){
    // Create query
    $query = 'SELECT
          id,
          name,
          selected,
          foto
        FROM
          ' . $this->table . '
          WHERE name = ?';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->name);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->selected = $row['selected'];
      $this->foto = $row['foto'];
  }
  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . ' SET name = :name, selected = :selected, foto = :foto' ;

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->selected = htmlspecialchars(strip_tags($this->selected));

  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':selected', $this->selected);
  $stmt-> bindParam(':foto', $this->foto);

  // Execute query
  if($stmt->execute()) {
    return true;
  }
      // error
      printf("Error: ", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
    name = :name,
    selected = :selected,
    foto = :foto
    WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->selected = htmlspecialchars(strip_tags($this->selected));
  $this->foto = htmlspecialchars(strip_tags($this->foto));
  $this->id = htmlspecialchars(strip_tags($this->id));

  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':selected', $this->selected);
  $stmt-> bindParam(':foto', $this->foto);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

      // error
      printf("Error: ", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

      // error
      printf("Error: ", $stmt->error);

    return false;
    }
  }