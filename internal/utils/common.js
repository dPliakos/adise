function addToCart(pid, qty, btn=null) {
  var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange = function() {
    if (this.readyState==4 && this.status == 200) showMessage();
  }
  xmlhttp.open("POST", "index.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("p=add_cart&pid=" + pid +"&quant=" + qty);
}

function showMessage(request) {
    alert("Added to cart!");
}
