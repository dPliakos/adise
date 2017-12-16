function addToCart(pid, qty, btn=null) {
  var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status == 200) showMessage();
  }
  xmlhttp.open("POST", "internal/ajax/add2cart.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("p=add_cart&pid=" + pid +"&quant=" + qty);
}

function showMessage(request) {
    alert("Added to cart!");
}

function requestOrders() {
  var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status == 200) showOrders(this.responseText);
  }
  xmlhttp.open("POST", "internal/get_orders.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}

function showOrders(txt) {
  document.getElementById("orders_container").innerHTML = txt;
}

$("#users").ready( () => {
  $.ajax(
    {
      url: "./internal/users/showAllUsers_json.php",
      success: (result) => {
        const decodedJson = JSON.parse(result);
        showUsers(decodedJson);
      }
    }
  )
});


function showUsers(userArray) {
  var html = "";

  userArray.forEach((record) => {
      html += "<tr>"
      for (key in record) {
        html += "<td> " + record[key] + " </td>";
      }
      html += "</tr>";
  });
  $("#content table tbody").html(html);
}



$("#users").ready(function() {
  console.log("uesrs ready");
});
