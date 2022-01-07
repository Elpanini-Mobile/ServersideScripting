<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Broodjes.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $broodje = new Broodjes($db);

  $data = json_decode(file_get_contents("php://input"));

  $broodje->title = $data->title;
  $broodje->price = $data->price;
  $broodje->description = $data->description;
  $broodje->foto = $data->foto;
  $broodje->category_id = $data->category_id;

  // Create broodje
  if($broodje->create()) {
    echo json_encode(
      array('message' => 'Broodjes Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Broodjes Not Created')
    );
  }