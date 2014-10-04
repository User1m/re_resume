<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

/* API  */

$order_num; $curr_num;


//get current number stored in 'store'
if(isset($_SESSION['store'])){
  $curr_num = $_SESSION['store'];
}else{
  $curr_num = "1";
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

  //get method
  case 'GET':
  //get curr number from store & display
  $order_num = $curr_num;
  $_SESSION['store'] = $curr_num;
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

print(json_encode($order_num));

exit();
?>
