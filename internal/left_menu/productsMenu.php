<ul class="nav sidebar-nav">
  <?php

      require_once "./internal/utils/dbconnect.php";

      if ($category_statement = $conn->prepare("SELECT Name, ID FROM category")) {
        $category_statement->execute();
      }

      $category_statement->bind_result($Name, $ID);

      while($category_statement->fetch())
        print "<li> <a href='?p=products&category=". $ID . "'> " . $Name . "</a> </li>";

   ?>
</ul>
