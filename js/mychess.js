$("body").ready(function () {
	draw_empty_board();
	fill_board();
  $("#next_move").click(()=>{
    movePion();
  });
	$("#btnStart").click(()=>{
		reset_board();
	});
});

function draw_empty_board() {

  var final_code = "<table id='chess_table'> ";

  for (var i=8; i>0; i--) {
    final_code += "<tr>";
    for (var j=1; j<=8; j++) {
      sid = "square_" + j + "_" + i;
      sclass = "chess_square " + ((i+j) % 2 == 0 ? "black" : "white") ;
      scontent = j + "," + i;

      final_code += "<td id='" + sid  + "' class='" + sclass + "' >" + scontent + "</div>";
    }
    final_code += "</tr>";
  }
  final_code += "</table>";

  $("#chess_board").html(final_code);
}

function reset_board() {
	$.ajax({url: "chess.php/board", method: 'POST',
		success: fill_board_by_data,
		error: display_error_move
	});
}

function movePion() {

  var ar = $("#move").val().split(" ");
  var old_x = ar[0], old_y = ar[1], new_x = ar[2], new_y = ar[3];
  var args = {x: new_x, y: new_y};
  var a = JSON.stringify(args);

  $.ajax({url: "chess.php/board/piece/"+old_x+'/'+old_y+'/', method: 'PUT',
    data : a,
    headers: { "Content-Type": "application/json"},
    success: fill_board_by_data,
    error: display_error_move
  });
}

function fill_board() {
	$.ajax({url: "./chess.php/board", success: fill_board_by_data });
}

function fill_board_by_data(data,status,metadata) {
	console.log(data);
  var count = 0;
  for (var i=0; i<data.length; i++) {
    count++;
    var current = data[i];
    var target = "square_" + current.x  + "_" + current.y;
    var name =   "./img/" + current.piece_color + current.piece + ".png" ;
    var content =  current.piece != null ? "<img src='"+ name + "' />" : "";
    $("#" + target).html(content);
  }
}

function display_error_move(a, b, c) {
	console.log(a);
	console.log(b);
	console.log(c);
	if (JSON.parse(a.responseText).error)
		alert(JSON.parse(a.responseText).error);
}
