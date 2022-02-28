<?php

use Patient\Database;

header("Content-type: application/json");

require '../init.php';

$db = new Database();
try {
	$db->connect();

	$data = $db->select('documentations');

	// Select name from Database for each of the documentations and add it

	$new = array_map(function ($arr) use ($db) {
		$name = $db->select('biodata', 'name', where: "hospital_number='" . $arr['hospital_number'] . "'")[0];
		$arr['name'] = $name['name'];
		return $arr;
	}, $data);

	echo json_encode($new);
} catch (Exception $e) {
	echo json_encode([]);
}

// $filename = str_replace('/', DIRECTORY_SEPARATOR, "$_SERVER[DOCUMENT_ROOT]/data/documentation.csv");

// echo json_encode(compileCsvToJson($filename));
