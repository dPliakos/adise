<?php
  //if (! isset($_SESSION))
  session_start();

  // create connection to database
  $host="";
  $user="root";
  $password="123";
  $database ="bookstoredb";

  $conn = new mysqli($host, $user, $password, $database, null, "/home/student/it/2015/it154524/mysql/run/mysql.sock");
  if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

  // test if is admin
  $isAdmin = false;
  if (!isset($_SESSION["username"]) || !isset($_SESSION["userid"])) $isAdmin = false;
  else {
    $sql = "SELECT is_admin FROM customer WHERE id=?";
    $stat = $conn->prepare($sql);
    $stat ? $stat->bind_param("i", $_SESSION["userid"]) : die("sql syntax error");
    $stat ? $stat->execute()                       : die("sql bind error");
    $stat ? $stat->bind_result($result)            : die("sql execute error");
    $stat->fetch();
    $isAdmin = $result == 1;
  }
  $conn->close();

  if (! $isAdmin) {
    die ("You are not authorized to enter here.");
  }

  $conn = new mysqli($host, $user, $password, $database, null, "/home/student/it/2015/it154524/mysql/run/mysql.sock");
  if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

  // start main query
  $sql = "select FName, LName, Address, Phone, uname, is_admin from customer";
  $result = $conn->query($sql);
  $res = $result->fetch_all(MYSQLI_ASSOC);

  print json_encode($res);
 ?>
