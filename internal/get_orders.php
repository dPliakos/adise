
<table class="table table-striped">
  <thead>
    <tr> <th> cid </th> <th> Customer </th> <th>date </th> </tr>
  </thead>
  <tbody>
    <?php
      require "./utils/dbconnect.php";
      require "./utils/common.php";
      $customers = array();

      $sql = "SELECT Customer, oDate FROM orders";
      $sql = $conn->prepare($sql);
      $sql ? $sql->execute() : die("sql syntax error");
      $sql ? $sql->bind_result($cid, $date) : die("sql exec error");
      $sql ? $sql->fetch()   : die("sql result error");

      while ($row = $sql->fetch()) {

        if (!isset($customers[$cid]) || $customers[$cid] == "") {
          $customers[$cid] = get_user($cid);
        }

        print "<tr>";
        print "<td> $cid </td> <td> ". as_name($customers[$cid]["fname"], $customers[$cid]["lname"])  ." </td> <td> $date </td> ";
        print "</tr>";
      }
     ?>
  </tbody>
</table>
