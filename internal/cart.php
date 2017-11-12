<br/> <br/>
<div class="panel panel-default col-md-10 product">
  <h3> Καλάθι αγορών </h3>
  <div>
    <?php
      require "internal/utils/dbconnect.php";
      require_once "internal/utils/common.php";

      if (isRequested("add_cart")) {
        if (isValidCartRequest()) {
          $_SESSION["cart"][$_REQUEST["pid"]] = $_REQUEST["quant"];
        } else {
          print "invalid request";
        }
      } elseif(isRequested("empty_cart")) {
        unset($_SESSION["cart"]);
      } elseif(isRequested("buy")) {
        if (!isLoggedIn()) die("You have to log in to buy");
        if (!cartExist())  die("Cart is empty");

        $sql="INSERT INTO orders (customer, oDate) values (?, now())";
        $buy_stat = $conn->prepare($sql);
        $buy_stat ? $buy_stat->bind_param("i", $_SESSION["userid"]) : die("sql buy1 syntax error");
        $buy_stat ? $buy_stat->execute()                            : die("sql bind error");

        $orderid = $conn->insert_id;
        require "internal/utils/dbconnect.php";
        $sql="INSERT INTO orderdetails (Orders, Quantity, Product) values(?, ? , ?)";
        $buy_stat = $conn->prepare($sql);
        foreach ($_SESSION["cart"] as $pid => $quant) {
          $buy_stat ? $buy_stat->bind_param("iii", $orderid, $quant, $pid) : die("sql buy2 syntax error");
          $buy_stat ? $buy_stat->execute()                                 : die("sql bind error");
        }
        print "Order Successfully!";
        unset($_SESSION["cart"]);
      }

      if (cartExist()) {
        print "<div class='row bold'>";
        print "<div class='col-md-8'> Title </div>";
        print "<div class='col-md-2'> Quantity </div>";
        print "<div class='col-md-2'> Price </div>";
        print "</div> <br/>";
      } else {
        print "<h3> Cart is empty. </h3>";
        return;
      }

      $cart_stat = $conn->prepare("SELECT Title, Price FROM product WHERE ID=?");
      $sum = 0;

      foreach ($_SESSION["cart"] as $pid => $quantity) {
        $cart_stat ? $cart_stat->bind_param("i", $pid): die("sql syntax error");
        $cart_stat ? $cart_stat->execute()            : die("sql param  error");
        $cart_stat ? $cart_stat->bind_result($title, $price)  : die("sql execute error");
        $cart_stat ? $cart_stat->fetch()              : die("sql result error");
        $subtotal = $price * $quantity;
        $sum += $subtotal;
        print "<div class='row'>";
        print "<div class='col-md-8'> $title </div>";
        print "<div class='col-md-2'> $quantity </div>";
        print "<div class='col-md-2'> $subtotal  </div>";
        print "</div>";
      }
     ?>
     <br/>
     <div class='row'>
       <div class='col-md-8'>
         <form class='col-md-4' method="get">
           <input type="text" name="p" value="empty_cart" hidden/>
           <input type="submit" value="Άδειασμα καλαθιού" class="btn btn-alert" hidden/>
         </form>
         <form class='col-md-3 col-md-offset-1' method="get">
           <input type="text" name="p" value="buy" hidden/>
           <input type="submit" value="Αγορά" class="btn btn-primary" />
         </form>
      </div>
       <div class='col-md-4'> Total: <?php print $sum  ?> </div>
     </div>
  </div>
</div>
