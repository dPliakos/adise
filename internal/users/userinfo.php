<br/> <br/>
<div class="panel panel-default col-md-10 product">
  <h3> Στοιχεία χρήστη </h3>
  <div>
    <?php
      require "./internal/utils/dbconnect.php";

      if (isset($_REQUEST["save"]) && $_REQUEST["save"]=='t') {
        $stat = "UPDATE customer  SET FName=?, LName=?, Address=?, Phone=? WHERE ID = ?";
        $stat = $conn->prepare($stat);
        $stat ? $stat->bind_param("ssssi",
          $_REQUEST["fn"],
          $_REQUEST["ln"],
          $_REQUEST["ad"],
          $_REQUEST["pn"],
          $_SESSION["userid"])
          : die("sql syntax error");
        $stat ? $stat->execute() : die("sql bind error");
      }

      $stat = "SELECT FName, LName, Address, Phone FROM customer WHERE ID = ?";
      $stat = $conn->prepare($stat);
      $stat ? $stat->bind_param("i", $_SESSION["userid"]) : die("sql syntax error");
      $stat ? $stat->execute()                            : die("sql bind error");
      $stat ? $stat->bind_result($fname, $lname, $addr, $phone) : die("sql execute error");
      $stat->fetch();
    ?>
    <form class="form-group" method="POST">
      <label> First Name : </label>
      <input type="text" value=<?php print $fname; ?> class="form-control" name="fn"/>
      <br/>
      <label> Last Name : </label>
      <input type="text" value=<?php print $lname; ?> class="form-control" name="ln"/>
      <br/>
      <label> Address : </label>
      <input type="text" value=<?php print $addr; ?> class="form-control" name="ad"/>
      <br/>
      <label> Phone number : </label>
      <input type="text" value=<?php print $phone; ?> class="form-control" name="pn"/>
      <br/>
      <input type="submit" class="btn btn-primary" value="Save" action="?"/>
      <input type="text" name="p" value="userinfo" hidden/>
      <input type="text" name="save" value="t" hidden/>
    </form>
  </div>
</div>
