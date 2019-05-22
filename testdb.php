<?php
$servername = "us-cdbr-iron-east-02.cleardb.net";
$username = "bf8e64f9a7cf0e";
$password = "98defd33";
$dbname = "heroku_a1f88e2862f189b";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

//mysql://bf8e64f9a7cf0e:98defd33@us-cdbr-iron-east-02.cleardb.net/heroku_a1f88e2862f189b?reconnect=true
?>