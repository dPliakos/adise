<?php
function isLoggedIn() {
    return (isset($_SESSION["username"]) && $_SESSION["username"] != "?");
}

function isAdmin() {
  return (isset($_SESSION["username"]) && $_SESSION["username"] == "admin");
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
?>
