<?php
session_start();

$qty = $_REQUEST["quant"];
$pid = $_REQUEST["pid"];

if (!isset($_SESSION["cart"])) $_SESSION["cart"] = array();
$_SESSION["cart"][$pid] > 0
  ? $_SESSION["cart"][$pid] += $qty
  : $_SESSION["cart"][$pid] = $qty;
?>
