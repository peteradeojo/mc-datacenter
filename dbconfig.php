<?php

$cxn = new mysqli(hostname: $_ENV['DBHOST'], username: $_ENV['DBUSER'], password: $_ENV['DBPASSWD'], database: $_ENV['DBNAME']);
