<?php

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

/* API  */

$order_num; $curr_num;


if(isset($_SESSION['store'])){
  $curr_num = $_SESSION['store'];
}else{
  $curr_num = "1";
  $_SESSION['store']= $curr_num;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

  //get method
  case 'GET':

  if($_SESSION['store']){
    global $order_num;

    $order_num = $_SESSION['store'];
    $_SESSION['store'] = $order_num;
  }else{
    $order_num = "empty";
  }

  break;

  //post method
  case 'POST':

  global $order_num;


   //store prev number
  $_SESSION['store'] = $curr_num;

  //get new number
  $curr_num = htmlentities($_POST['order_num']);

  //display new number
  if($_POST['order_num']){
      $order_num = $_POST['order_num'];
  }else{
          $order_num = var_dump($_POST);
  }

  break;

  default:
  $order_num = "Bad request";
  break;
}

print(json_encode($order_num));

exit();
?>
