<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


/* API  */
global $curr_num , $prev_num;

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
  if(!empty($curr_num)){
    $order_num = $curr_num;
  }else{
    $order_num = "1";
  }
  break;

  case 'POST':
  $prev_num = $curr_num;
  $curr_num = htmlentities($_POST['order_num']);
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

