<br/> <br/>
<div class="panel panel-defaultcol-md-6">
  <div>
    <?php
      require "./internal/utils/dbconnect.php";

      $prod_stat = $conn->prepare("SELECT Title, Price FROM product where Category = ?");
      $prod_stat ? $prod_stat->bind_param("i", $_REQUEST["category"]) : die ("sql error");
      $prod_stat ? $prod_stat->execute()                              : die ("sql error");
      $prod_stat->bind_result($title, $price);

      while($prod_stat->fetch()) {
        print "<div class='row product'>";
        print " <div class='col-md-8 product-title'> " . addslashes($title) . "</div>";
        print " <div class='col-md-4 product-type'> " . addslashes($price) . "€ </div>";
        print "</div>";
      }

     ?>
  </div>
</div>
