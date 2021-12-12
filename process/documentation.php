<?php

use Patient\Documentation;

require '../init.php';

if (!$_POST) {
  header("Location: /");
}

$doc = new Documentation($_POST);
try {
  $doc->connect();
  $doc->save();
  // header("Content-type: application/json");
  // echo json_encode(($doc));
  // exit();
  flash(['mode' => 'success', 'message' => 'Documentation recorded successfully', 'title' => '']);
} catch (Exception $e) {
  flash(['mode' => 'danger', 'message' => $e->getMessage(), 'title' => '']);
  echo $e->getMessage();
} finally {
  header("Location: /");
}
