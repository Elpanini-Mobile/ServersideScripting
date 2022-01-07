<?php
// required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Gebruikers.php';

// instantiate database and Gebruiker object
$database = new Database();
$db = $database->connect();

// initialize object
$gebruiker = new Gebruikers($db);

// query Gebruiker
$result = $gebruiker->read();
$num = $result->rowCount();

// check if more than 0 record found
if($num > 0){

    // Gebruiker array
    $gebruikers_arr = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $gebruikers_item = array(
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'email' => $email
        );

        array_push($gebruikers_arr, $gebruikers_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show Gebruikers data in json format
    echo json_encode($gebruikers_arr);
}

else{

  // set response code - 404 Not found
  http_response_code(404);

  // tell the user no Gebruikers found
  echo json_encode(
      array("message" => "No Gebruikers found.")
  );
}
