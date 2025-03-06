<?php
define('DB_HOST', 'localhost');         // zamerne
define('DB_USER', 'root');              // zamerne
define('DB_PASS', '');                  // zamerne
define('DB_NAME', 'carmanager_pit');

// automaticke pripojenie k databaze pri nacitani suboru
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// check
if ($mysqli->connect_error) {
    die("[ERROR!] Pripojenie zlyhalo: " . $mysqli->connect_error);
}

?>