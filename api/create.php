<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once "../class/ProductsClass.php";

  //if request is a preflight request return 0
  if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    return 0;
  }

  $statusCode = 200;
  $message = '';  

   // Get raw posted data

  $_POST = json_decode(file_get_contents("php://input"));

  try{
    //instantiate ProductClass

    $productClass = new ProductsClass(
      $_POST->sku,
      $_POST->category_id,
      $_POST->name,
      $_POST->price,
      $_POST->details,
      
    );

    //Store Product in the Database
    
    $productClass->storeProduct();
    $message = 'Product Stored succesfully';
    $statusCode = 201;

  }catch(Exception $e){
    $statusCode = 401;
    $message = 'Error Adding Product. NB sku must be unique';
  }
  
  echo json_encode(array(
      'status'  => $statusCode,
      'message' => $message,
  ));

