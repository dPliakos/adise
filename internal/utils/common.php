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

function closeDbConnection() {
  if (isset($conn)) $conn->close();
}
?>
