Proccessing login.....

<?php
	$u = $_REQUEST['username'];
	$p = $_REQUEST['pass'];

	if($u == 'admin' && $p=='123') {
		print "Welcome admin";
		$_SESSION['username'] = 'admin';
		header("Refresh:0; url=index.php");
	}elseif($u=='antonis' && $p=='456') {
		print "Welcome antnis";
			$_SESSION['username'] = 'antonis';
			header("Refresh:0; url=index.php");
	} else {
		print " <h3> Unknown user </h3>";
		$_SESSION['username'] = '?';
	}
?>
