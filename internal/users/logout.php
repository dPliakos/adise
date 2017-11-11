<?php
  require_once "internal/utils/common.php";

  if (isLoggedIn()) {
    unset($_SESSION["username"]);
    header("Refresh:0");
  } else {
    print '<h2 class="col-md-5 col-md-offset-2"> You logged out! </h2>';
  }

 ?>
 <br/><br/>
