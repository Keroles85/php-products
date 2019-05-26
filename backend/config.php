<?php 

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'keroles');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'furniture');

try {
  $db = new PDO('mysql:host=' . DB_SERVER . ';dbname='. DB_NAME, DB_USERNAME, DB_PASSWORD);
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("ERROR: Could not connect. " . $e->getMessage());
}

?>