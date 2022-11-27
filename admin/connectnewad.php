<?php
$servername = "localhost";
$username = "root";
$password = "";
$option=array(
PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
);

try {
  $con = new PDO("mysql:host=$servername;dbname=exclusive", $username, $password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?> 