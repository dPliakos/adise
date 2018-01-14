
<?php

require_once "lib/dbconnect.php";
require_once "lib/show_board.php";

function move_board_piece($x,$y, $x1, $y1) {
  require "./lib/dbconnect.php";
  $sql = "select * from board where x=? and y=?";
  $sql = $conn->prepare($sql);
  $sql->bind_param("ii", $x, $y);
  $sql->execute();
  $result = $sql->get_result();
  $old_position = $result->fetch_assoc();

  if (!$old_position["piece"]) {
    header("HTTP/1.1 500 Internal Server Error");
    header('Content-type: application/json');
    print json_encode(['error' => 'Δεν υπάρχει πιόνι στο σημείο έναρξης.']);
    return;
  }

  require "./lib/dbconnect.php";
  $sql = "select * from board where x=? and y=?";
  $sql = $conn->prepare($sql);
  $sql->bind_param("ii", $x1, $y1);
  $sql->execute();
  $result = $sql->get_result();
  $new_position = $result->fetch_assoc();

  if ($new_position["piece"]) {
    header("HTTP/1.1 500 Internal Server Error");
    header('Content-type: application/json');
    print json_encode(['error'=>'υπάρχει πιόνι στο σημείο τερματισμού.']);
    return;
  }

  require "./lib/dbconnect.php";
  $sql = "update board set piece='" . $old_position["piece"] . "', piece_color='" . $old_position["piece_color"] . "' where x=" . $x1 . " and y=" . $y1;
  $sql = $conn->prepare($sql);
  // $sql->bind_param("ssii", ($old_position["piece"]), ($old_position["piece_color"]),  $x1, $y2);
  // print($sql->error);
  $sql->execute();
  // print($sql->error);


  $sql = "update board set piece=null, piece_color=null where x=? and y=?";
  $sql = $conn->prepare($sql);
  $sql->bind_param("ii",  $x, $y);
  $sql->execute();

  show_board();

}

function reset_board() {
  require "./lib/dbconnect.php";
  $sql = "replace into board select * from board_empty";
  $sql = $conn->prepare($sql);
  $sql->execute();
  show_board();
}

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

switch ($r=array_shift($request)) {
    case 'board' :

                     switch ($b=array_shift($request)) {
                                case '':
                                case null: handle_board($method);
                                                break;
                                case 'piece':  handle_piece($method, $request[0],$request[1],$input);
                                                break;
                                case 'player': handle_player($method, $request[0],$input);
                                                break;
                                default: header("HTTP/1.1 404 Not Found");
                                                break;
         }
         break;
    default:  header("HTTP/1.1 404 Not Found");
                        exit;
}

function handle_board($method) {

        if($method=='GET') {
                show_board();
        } else if ($method=='POST') {
                reset_board();
        }
}

function handle_piece($method, $x,$y,$input) {

 if ($method == 'PUT') {

    move_board_piece($x, $y, $input["x"], $input["y"]);
 }

}

function handle_player($method, $p,$input) {
      ;
}

?>
