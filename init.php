<?php

use Dotenv\Dotenv;

session_start();

require 'vendor/autoload.php';
require 'autoload.php';
require 'src/functions.php';

// if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1" or $_SERVER["REMOTE_ADDR"] == "::1") {
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
// }

print_r($_ENV);

if (@$_SESSION['login'] !== true) {
  // print_r($_SESSION);
  // echo $_SERVER['SCRIPT_NAME'];
  // exit();
  if (!str_ends_with($_SERVER['SCRIPT_NAME'], "/login.php")) {
    header("Location: /login.php");
  }
}
