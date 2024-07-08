<?php
$servername = "localhost"; // Change this to your database server
$dbusername = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "giveandgather"; // Database name

// Create connection
$db = new mysqli($servername, $dbusername, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
