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

// echo @$_SESSION['login'] === true ? "Logged in" : "Not logged in";

if (@$_SESSION['login'] !== true) {
  if (!str_ends_with($_SERVER['SCRIPT_NAME'], "/login.php")) {
    header("Location: /login.php");
  }
}
