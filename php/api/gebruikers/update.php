<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Gebruikers.php';

// get database connection
$database = new Database();
$db = $database->connect();

$gebruiker = new Gebruikers($db);

// get id of Gebruiker to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of Gebruiker to be edited
$gebruiker->id = $data->id;

// set Gebruiker property values
$gebruiker->username = $data->username;
$gebruiker->password = $data->password;
$gebruiker->email = $data->email;

// update the Gebruiker
  if($gebruiker->update()) {
    echo json_encode(
      array('message' => 'gebruiker Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'gebruiker not updated')
    );
  }