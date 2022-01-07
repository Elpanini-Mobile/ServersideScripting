<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $category = new Category($db);

  // Get ID
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  $category->readOne();

  // Create array
  $category_arr = array(
    'id' => $category->id,
    'name' => $category->name,
    'selected' => $category->selected,
    'foto' => $foto
  );

  // Make JSON
  print_r(json_encode($category_arr));