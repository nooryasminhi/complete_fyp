<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo json_encode(["loggedin" => true]);
} else {
    echo json_encode(["loggedin" => false]);
}
?>
