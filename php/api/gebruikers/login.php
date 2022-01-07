<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Gebruikers.php';


// get database connection
$database = new Database();
$db = $database->connect();

// prepare Gebruiker object
$gebruiker = new Gebruikers($db);

// set email and password property of record to read
$gebruiker->email = isset($_GET['email']) ? $_GET['email'] : die();
$gebruiker->password = isset($_GET['password']) ? $_GET['password'] : die();

// read the details of Gebruiker to be edited
$gebruiker->login();

if($gebruiker->id!=null){
    // create array
    $gebruiker_arr = array(
        "id" =>  $gebruiker->id,
        "username" => $gebruiker->username
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($gebruiker_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user Gebruiker does not exist
    echo json_encode(array("message" => "Gebruiker does not exist."));
}
?>