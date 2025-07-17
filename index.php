<?php
// Database credentials
$host = 'localhost';
$user = 'root';
$pass = 'sanika@2003'; // Update with your DB password
$dbname = 'petheaven';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn) {
    echo "connection success";
} else {
    echo "Failed";
}
?>