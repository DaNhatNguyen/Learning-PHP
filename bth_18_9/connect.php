<?php
    $conn = new mysqli("localhost", "root", "", "67pm12");
    // check connection
    if ($conn->connect_error){
        die("connection failed: ".$conn->connect_error);
    }
?>