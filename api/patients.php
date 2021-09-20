<?php

use Patient\Database;

header("Content-type: application/json");

require '../init.php';

$db = new Database();
$db->connect();

$data = $db->select('biodata');

echo json_encode($data);
