<?php
 $conn= new mysqli('localhost', 'root','Kunj@1122','services');
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>