<?php

use Patient\Patient;

// TODO: Implement some basic validation and authentication

$patient = new Patient($_POST);
try {
	$patient->connect();
	$patient->update(true);
	flash(['message' => "record updated successfully", 'mode' => 'success', 'title' => 'Updating']);
} catch (Error $e) {
	flash(['message' => $e->getMessage(), 'mode' => 'danger', 'title' => 'Updating']);
	// echo $e->getMessage();
} finally {
	header("Location: /");
}
exit();
