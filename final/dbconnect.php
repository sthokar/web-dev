<?php

$db_host = "localhost";
$db_name = "hello";
$db_user = "root";
$db_pass = "internetking1";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

