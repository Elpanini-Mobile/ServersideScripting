<?php
  // Headers
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../../config/Database.php';
  include_once '../../models/Broodjes.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $broodje = new Broodjes($db);

  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $broodje->id = $data->id;

  // Delete post
  if($broodje->delete()) {
    echo json_encode(
      array('message' => 'broodje Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'broodje Not Deleted')
    );
  }