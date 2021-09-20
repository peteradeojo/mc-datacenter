<?php

use Patient\Database;

header("Content-type: application/json");

require '../init.php';

$db = new Database();
try {
	$db->connect();

	$data = $db->select('documentations');

	// Select name from Database for each of the documentations and add it
	for ($i = 0; $i < count($data); $i += 1) {
		$name = $db->select('biodata', 'name', where: "hospital_number='" . $data[$i]['hospital_number'] . "'")[0];
		$data[$i]['name'] = $name['name'];
	}

	echo json_encode($data);
} catch (Exception $e) {
	echo json_encode([]);
}

// $filename = str_replace('/', DIRECTORY_SEPARATOR, "$_SERVER[DOCUMENT_ROOT]/data/documentation.csv");

// echo json_encode(compileCsvToJson($filename));
