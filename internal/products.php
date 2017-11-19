<br/> <br/>
<div class="panel panel-default col-md-10">
  <div>
    <?php
      require "./internal/utils/dbconnect.php";

      $cat_stat = $conn->prepare("SELECT Name from category WHERE ID = ?");
      $cat_stat ? $cat_stat->bind_param("i", $_REQUEST["category"]) : die ("sql syntax error");
      $cat_stat ? $cat_stat->execute()                               : die ("sql bind param error ");
      $cat_stat->bind_result($name);

      print ($cat_stat->fetch() ? "<h3> $name </h3><hr/>" : "");

      require "./internal/utils/dbconnect.php";
      $prod_stat = $conn->prepare("SELECT ID, Title, Price FROM product where Category = ?");
      $prod_stat ? $prod_stat->bind_param("i", $_REQUEST["category"]) : die ("sql syntax error");
      $prod_stat ? $prod_stat->execute()                              : die ("sql param error");
      $prod_stat->bind_result($ID, $title, $price);

      while($prod_stat->fetch()) {
        print "<div class='row product_line' >";
          print "<a href='?p=product&category=${_REQUEST['category']}&product=$ID' >";
          print " <div class='col-md-8 product-title'> " . $title . "</div>";
          print " <div class='col-md-1 product-type'> " . as_price($price) . "</div>";
          print "</a>";
          print " <div class='col-md-2 btn btn-default' onclick='addToCart($ID, 1)'> To Cart </div> ";
        print "</div><br>";
      }

     ?>
  </div>
</div>
