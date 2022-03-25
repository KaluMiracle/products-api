<?php 
  // Headers
  require_once '../../vendor/autoload.php';

  use Source\Controller\ProductController;

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


  //if request is a preflight request end the execution
  if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    return;
  }

  $statusCode = 200;
  $message = '';  

   // Get raw posted data

  $_DATA = json_decode(file_get_contents("php://input"));

  try{
    //instantiate ProductControllerClass

    $productClass = new ProductController(
      $_DATA->sku,
      $_DATA->category_id,
      $_DATA->name,
      $_DATA->price,
      $_DATA->details
      
    );

    $function = 'store'.$productClass->category_id;

    //Store Product in the Database
    
    $productClass->$function();
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

