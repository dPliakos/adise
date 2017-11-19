<?php
function isLoggedIn() {
    return (isset($_SESSION["username"]) && $_SESSION["username"] != "?");
}

function isAdmin() {
  if (!isset($_SESSION["username"]) || !isset($_SESSION["userid"])) return false;
  require "internal/utils/dbconnect.php";

  $sql = "SELECT is_admin FROM customer WHERE id=?";
  $stat = $conn->prepare($sql);
  $stat ? $stat->bind_param("i", $_SESSION["userid"]) : die("sql syntax error");
  $stat ? $stat->execute()                       : die("sql bind error");
  $stat ? $stat->bind_result($result)            : die("sql execute error");
  $stat->fetch();
  return $result == 1;
}

function isRequested($page) {
  return (isset($_REQUEST["p"]) && $_REQUEST["p"] == $page);
}

function cartExist() {
  return (isset($_SESSION["cart"]) && is_array($_SESSION["cart"]));
}

function isValidCartRequest() {
  return (isset($_REQUEST["pid"]) && isset($_REQUEST["quant"]) && $_REQUEST["quant"] > 0);
}

function closeDbConnection() {
  if (isset($conn)) $conn->close();
}

function addToCart($pid) {
  if (!is_array($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
  }
}

function as_price($num) {
  return $num . "€";
}

function as_name($fname, $lname) {
  return "$fname $lname";
}

function get_user($id) {
  require "./utils/dbconnect.php";
  $customer = array();
  $sql = "SELECT Fname, Lname, Address, Phone, uname FROM customer WHERE ID=?";
  $statement = $conn->prepare($sql);
  $statement ? $statement->bind_param("i", $id) : die("sql syntax error");
  $statement ? $statement->execute()       : die("sql bind error");
  $statement ? $statement->bind_result($fname, $lname, $address, $phone, $username) : die ("sql error");
  $statement ? $statement->fetch() : die ("sql error");

  if (!isset($username)) return null;

  $customer["fname"] = $fname;
  $customer["lname"] = $lname;
  $customer["address"] = $address;
  $customer["phone"] = $phone;
  $customer["uname"] = $username;
  return $customer;
}

function get_order($oid) {

}
?>
