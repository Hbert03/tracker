<?php

$conn1 = new mysqli("192.168.88.215", "jda", "passw0rd456", "depedldn_tracker");


if ($conn1->connect_error) {
    die("Connection failed to depedldn_tracker: " . $conn1->connect_error);
}

$conn2 = new mysqli("192.168.88.215", "jda", "passw0rd456", "depedldn");

if ($conn2->connect_error) {
    die("Connection failed to depedldn: " . $conn2->connect_error);
}

?>
