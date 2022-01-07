<?php
// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Gebruikers.php';

$database = new Database();
$db = $database->connect();

$gebruiker = new Gebruikers($db);

$data = json_decode(file_get_contents("php://input"));

    // set Gebruiker property values
    $gebruiker->username = $data->username;
    $gebruiker->password = $data->password;
    $gebruiker->email = $data->email;

  // Create Gebruiker
  if($gebruiker->create()) {
    echo json_encode(
      array('message' => 'gebruiker Created')
    );
  } else {
    echo json_encode(
      array('message' => 'gebruiker Not Created')
    );
  }
  ?>