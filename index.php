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
<title> my php store </title>
<!-- <link href="layout.css" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="./custom.css" />
</head>

<body>
<!-- navigation bar -->
<div id="top"  class="navbar navbar-inverse" >
	<div class="container-fluid">
		<div class="navbar-header">
      <a class="navbar-brand" href="index.php">5o Εργαστήριο</a>
    </div>
		<ul class="nav navbar-nav">
			<li> <a href="index.php?p=start">Αρχική</a> </li>
			<li> <a href="?p=products">Προϊόντα</a> </li>
			<li> <a href="?p=shopinfo">Κατάστημα</a> </li>
			<li> <a href="?p=cart">Καλάθι Αγορών </a> </li>
		</ul>
		<ul class="nav navbar-nav">
			<?php
				require_once "./internal/utils/common.php";
				// show login button only if a user is not logged in.
				if (!isLoggedIn()) print '<li> <a href="?p=login">Login</a> </li>';
			?>
		</ul>
	</div>
</div>

<!-- sidebar left start -->
<div class=" sidebar col-md-12">
	<div id="left" class="col-md-3" >
	<?php
		require_once "./internal/utils/common.php";

		// if products is open, show the categories menu.
		if (isRequested("products") || isRequested("product")) {
			print "<h2> Categories </h2>";
			require "./internal/left_menu/productsMenu.php";
		}
		// if is logged in, show the user menu.
		if (isLoggedIn()) {
			print "<h2> Welcome " . $_SESSION["username"] . "</h2>";

		// if is admin, show the admin menu too.
			if(isAdmin()) require "./internal/left_menu/admin_menu.php";
			require "./internal/left_menu/costumer_menu.php";
		}
	?>
	</div>

	<!-- main content start -->
	<div id="content" class="col-md-8">
	<?php
	if( ! isset($_REQUEST['p'])) {
		$_REQUEST['p']='start';
	}
	$p = $_REQUEST['p'];
	//print "must require page: internal/$p";
	switch ($p){
	case "start" :		require "./internal/start.php";
						break;
	case "products" : require "./internal/products.php";
						break;
	case "product" 	: require "./internal/product.php";
						break;
	case "shopinfo"	: require "internal/shopinfo.php";
						break;
	case "cart"			:
	case "empty_cart":
	case "buy"			:
	case "add_cart" : require "internal/cart.php";
						break;
	case "login" :		require "internal/users/login.php";
						break;
	case 'do_login':	require "internal/users/do_login.php";
						break;
	case 'logout': require "internal/users/logout.php";
						break;
	case 'userinfo': require "internal/users/userinfo.php";
						break;
	default:
		print "Η σελίδα δεν υπάρχει";
	}
	?>
	</div>
</div>
<!-- footer start -->
<div id="footer"></div>
</body>
</html>
