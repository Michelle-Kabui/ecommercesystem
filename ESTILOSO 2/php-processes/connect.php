<?php
$dbName = "estiloso";

//creating a connection
$conn = mysqli_connect("localhost", "root", "", $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>