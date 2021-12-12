<?php

use Patient\Database;

header("Content-type: application/json");

require '../init.php';

$db = new Database();
$db->connect();

$data = $db->select('biodata');

for ($i = 0; $i < count($data); $i++) {
  switch ($data[$i]['gender']) {
    case 1:
      $data[$i]['gender'] = 'M';
      break;
    default:
      $data[$i]['gender'] = 'F';
  }
}

echo json_encode($data);
