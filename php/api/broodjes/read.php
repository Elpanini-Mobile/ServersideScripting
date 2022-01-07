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

  $result = $broodjes->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    $brood_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $brood_item = array(
        'id' => $id,
        'title' => $title,
        'price' => $price,
        'description' => html_entity_decode($description),
        'foto' => $foto,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      array_push($brood_arr, $brood_item);
    }

    // Turn to JSON & output
    echo json_encode($brood_arr);
  } else {
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }