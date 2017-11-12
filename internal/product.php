<br/> <br/>
<div class="panel panel-default col-md-8 product">
  <div>
    <?php
      require "./internal/utils/dbconnect.php";
      $sprod_stat = $conn->prepare("SELECT Title, Description, Price FROM product WHERE id=?");
      $sprod_stat ? $sprod_stat->bind_param("i", $_REQUEST["product"]) : die ("SQL prepare eroor");
      $sprod_stat ? $sprod_stat->execute()                             : die ("SQL prepare error");
      $sprod_stat ? $sprod_stat->bind_result($title, $desc, $price)    : die ("SQL execute error");

      $sprod_stat->fetch();

      print "<h3>" . $title . "</h3>";
      print "<div class='col-md-12'>" . $desc . "</div>";
     ?>
     <br /> <br/>
     <div class="row">
       <form class="col-md-10" method="get">
         <input type="number" name="quant" value="1"/>
         <input type="submit" value="Προσθήκη" />
         <input type="text" name="pid" value=<?php print $_REQUEST["product"] ?> hidden />
         <input type="text" name="p" value="add_cart" hidden />
       </form>
    </div>
   </div>
 </div>
