<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

/* API  */
if(isset($_SESSION['curr_num'])){
 $curr_num = $_SESSION['curr_num'];
}else{
  $_SESSION['curr_num'] = "1";
  $curr_num = $_SESSION['curr_num'];
}

if(isset($_SESSION['prev_num'])){
  $prev_num = $_SESSION['prev_num'];
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
  if(!empty($curr_num)){
    $order_num = $curr_num;
  }
  break;

  case 'POST':
  //store prev number
  $_SESSION['prev_num'] = $curr_num;

  //get new number
  $curr_num = htmlentities($_POST['order_num']);

  //store new number
  $_SESSION['curr_num'] = $curr_num;

  //display new number
  $order_num = $curr_num;
  break;

  default:
  $order_num = "Bad request";
  break;
}
// $order_num = htmlentities($_GET['order_num']);


print(json_encode($order_num));

exit();
?>

<?php

// function convertXML($xmldata){

//   $xml = simplexml_load_string($xmldata);
//   $json = json_encode($xml);
//   $arr = json_decode($json, TRUE);

//   return $arr;
// }

?>

