<?php
    $host="";
    $user="root";
    $password="123";
    $database ="bookstoredb";
    $path_to_socket = "/home/student/it/2015/it154524/mysql/run/mysql.sock"

    $conn = new mysqli($host, $user, $password, $database, null, $path_to_socket);

    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

?>
