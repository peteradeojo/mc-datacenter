<?php

use Patient\Patient;

require '../init.php';

$_POST['category'] = strtolower($_POST['category']);
$patient = new Patient($_POST);


// print_r($patient);
try {
  $patient->connect(); # connect to database
  // exit();
  $patient->save(); # save patient data to database
  flash(['mode' => 'success', 'message' => 'Patient registered successfully', 'title' => '']);
} catch (Exception $e) {
  flash(['mode' => 'danger', 'message' => $e->getMessage(), 'title' => '']);
} finally {
  header("Location: /");
}
