<?php
// Database credentials
$servername = "localhost";
$username = "u176143505_smirk";
$password = "o/:o9\$L2k";
$dbname = "u176143505_CSA";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
?>
