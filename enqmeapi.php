<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

/* API  */

$order_num, $curr_num;


if(isset($_SESSION['store'])){
  $curr_num = $_SESSION['store'];
}else{
  $curr_num = "1";
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

  // //get method
  case 'GET':
  if($_SESSION['store']){
    $order_num = $_SESSION['store'];
    $_SESSION['store'] = $order_num;
  }else{
    $order_num = "empty";
  }
  break;

  //post method
  case 'POST':

   //store prev number
  $_SESSION['store'] = $curr_num;

  //get new number
  $curr_num = htmlentities($_POST['order_num']);

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

