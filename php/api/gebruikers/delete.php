<?php
// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Gebruikers.php';


// get database connection
$database = new Database();
$db = $database->connect();

// prepare Gebruiker object
$gebruiker = new Gebruikers($db);

// get Gebruiker id
$data = json_decode(file_get_contents("php://input"));

// set Gebruiker id to be deleted
$gebruiker->id = $data->id;

// delete de Gebruiker
  if($gebruiker->delete()) {
    echo json_encode(
      array('message' => 'gebruiker deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'gebruiker not deleted')
    );
  }