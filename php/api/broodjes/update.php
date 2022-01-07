<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Broodjes.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $broodjes = new Broodjes($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $broodjes->id = $data->id;
  $broodjes->title = $data->title;
  $broodjes->price = $data->price;
  $broodjes->description = $data->description;
  $broodjes->foto = $data->foto;
  $broodjes->category_id = $data->category_id;

  if($broodjes->update()) {
    echo json_encode(
      array('message' => 'Broodjes Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Broodjes Not Updated')
    );
  }