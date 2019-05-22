<?php
$servername = "us-cdbr-iron-east-02.cleardb.net";
$username = "bf8e64f9a7cf0e";
$password = "98defd33";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>