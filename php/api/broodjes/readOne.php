<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Broodjes.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $broodjes = new Broodjes($db);

  // Get ID
  $broodjes->id = isset($_GET['id']) ? $_GET['id'] : die();

  $broodjes->readOne();

  // Create array
  $broodjes_arr = array(
    'id' => $broodjes->id,
    'title' => $broodjes->title,
    'price' => $broodjes->price,
    'description' => $broodjes->description,
    'foto' => $broodjes->foto,
    'category_id' => $broodjes->category_id,
    'category_name' => $broodjes->category_name
  );

  // Make JSON
  print_r(json_encode($broodjes_arr));