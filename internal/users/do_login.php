Proccessing login.....

<?php
	require "./internal/utils/dbconnect.php";

	$u = $_REQUEST['username'];
	$p = $_REQUEST['pass'];

	$sql = "SELECT uname FROM customer WHERE uname=? and passwd_enc=password(?)";
	$login_stat = $conn->prepare($sql);
	$login_stat ? $login_stat->bind_param("ss", $u, $p )  :	die("sql syntax error");
	$login_stat ? $login_stat->execute() 									: die("sql param error");
	$login_stat ? $login_stat->bind_result($uname)				: die("sql execute error");

	$login_stat->fetch();

	$_SESSION["username"] = isset($uname) ? $uname : "?";
	$_SESSION["username"] == '?' 				?
		print "<h3> unknown user </h3>"		:
		header("Refresh:0; url=index.php");
?>
