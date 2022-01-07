<?php
// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Gebruikers.php';

// get database connection
$database = new Database();
$db = $database->connect();

// prepare Gebruiker object
$Gebruiker = new Gebruikers($db);

// set ID property of record to read
$Gebruiker->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of Gebruiker to be edited
$Gebruiker->readOne();

if($Gebruiker->username!=null){
    // create array
    $Gebruiker_arr = array(
        "id" =>  $Gebruiker->id,
        "username" => $Gebruiker->username,
        "password" => $Gebruiker->password,
        "email" => $Gebruiker->email

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($Gebruiker_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user Gebruiker does not exist
    echo json_encode(array("message" => "Gebruiker does not exist."));
}
?>