<?php
function isLoggedIn() {
    return (isset($_SESSION["username"]) && $_SESSION["username"] != "?");
}

function isAdmin() {
  return (isset($_SESSION["username"]) && $_SESSION["username"] == "admin");
}
?>
