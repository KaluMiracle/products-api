<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, origin, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  require_once '../../vendor/autoload.php';

  use Source\Controller\ProductController;

  //if request is a preflight Request return 0

  if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    return 0;
  }

  // initialize return values
  $statusCode = 201;
  $message = 'Delete Successful';
  $data = array();

    // Get raw posted data
  $_DATA = json_decode(file_get_contents("php://input"));

  // Delete products
  foreach($_DATA->products as $p){

    if(ProductController::deleteProducts($p)) {
      array_push($data, 'Deleted: '. $p);
    } else {
      array_push($data, 'Delete Failed: '. $p);
      $statusCode = 401;
      $message= 'Delete Unsuccessful';
    }
  }

  //return result
  echo json_encode(array(
    'status'  => $statusCode,
    'message' => $message,
    'data'    => $data
));


  

