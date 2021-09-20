<?php

function flash(array $info = null)
{
  if ($info) {
    $_SESSION['flash'] = $info;
  } else {
    if (@$_SESSION['flash']) {
      $info = $_SESSION['flash'];
      echo <<<_
        <div class="alert alert-$info[mode] alert-dismissible fade show" role="alert">
          <strong>$info[title]</strong> <p>$info[message]</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      _;
      unset($_SESSION['flash']);
    }
  }
}

function compileCsvToJson($filename)
{
  $csvFile = @file($filename);
  $data = [];

  if (!$csvFile) {
    return $data;
  }

  $headers = explode(',', trim($csvFile[0]));

  for ($i = 1; $i < count($csvFile); $i += 1) {
    for ($x = 0; $x < count($headers); $x += 1) {
      $array[$headers[$x]] = str_getcsv($csvFile[$i])[$x];
    }
    $data[] = $array;
  }

  return $data;
}
