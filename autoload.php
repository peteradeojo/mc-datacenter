<?php

spl_autoload_register(function ($class) {
  $filepath = str_replace('/', DIRECTORY_SEPARATOR, "$_SERVER[DOCUMENT_ROOT]/src/$class.php");
  $filepath = str_replace('\\', DIRECTORY_SEPARATOR, $filepath);
  require $filepath;
});
