<?php
    $host="";
    $user="root";
    $password="123";
    $database ="bookstoredb";

    $conn = new mysqli($host, $user, $password, $database, null, "/home/student/it/2015/it154524/mysql/run/mysql.sock");

    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

?>
