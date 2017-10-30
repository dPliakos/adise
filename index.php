<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if( ! isset($_SESSION['username'])) {
	$_SESSION['username']='?';
}
?>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<link href="layout.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="top">
<a href="index.php?p=start">Αρχική</a>
<a href="?p=shopinfo">Κατάστημα</a>
<a href="?p=products">Προϊόντα</a>
<a href="?p=login">Login</a>
</div>
<div id="left">
<?php
	print "<p>This is user: $_SESSION[username]</p>";
	if($_SESSION['username']=='admin') {
		print "<h2>Admin MENU</h2>";
	}
?>
</div>
<div id="content">
<?php
if( ! isset($_REQUEST['p'])) {
	$_REQUEST['p']='start';
}
$p = $_REQUEST['p'];
print "must require page: internal/$p";
switch ($p){
case "start" :		require "internal/start.php";
					break;
case "shopinfo": 	require "internal/shopinfo.php";
					break;
case "login" :		require "internal/login.php";
					break;
case 'do_login':	require "internal/do_login.php";
					break;

default: 
	print "Η σελίδα δεν υπάρχει";
}
?>
</div>
<div id="footer"></div>
</body>
</html>
