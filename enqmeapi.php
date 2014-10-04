<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

/* API  */
global $order_num;

if($_SESSION['curr_num']){
 $curr_num = $_SESSION['curr_num'];
 $_SESSION['curr_num'] = $curr_num;
}else{
  $curr_num = "curr";
  $_SESSION['curr_num'] = $curr_num;
}

if($_SESSION['prev_num']){
  $prev_num = $_SESSION['prev_num'];
  $_SESSION['prev_num'] = $prev_num;
}else{
  $_SESSION['prev_num'] = "prev";
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

  //get method
  case 'GET':

  if(!empty($curr_num)){
    $order_num = $curr_num;
  }else{
    $order_num = "Null number";
  }
  break;

  //post method
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

