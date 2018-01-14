<?php

function show_board() {

  require "./lib/dbconnect.php";
  $sql = "select * from board";
  $sql = $conn->prepare($sql);
  $sql ? $sql->execute() : die("error");
  $sql ? $result = $sql->get_result() : die("error2");
  $sql ? $result = $result->fetch_all(MYSQLI_ASSOC) : die("error3");

  header('Content-type: application/json');
  print(json_encode($result));
}
?>
