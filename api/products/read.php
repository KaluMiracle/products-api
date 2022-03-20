<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  require '../../Controller/Product.php';

  // include_once "../../Controller/Product.php";
  use Controller\Product;

  // initialize return values
  $statusCode = 201;
  $message = '';
  $data = array();

  //get Products from database

  $result = Product::getProducts();

  // Get row count
  $num = mysqli_num_rows($result);

  try{
    // Check if any product in database
    if($num > 0) {
    
        foreach($result as $row) {
            extract($row);

            $product_item = array(
                'sku' => $sku,
                'name' => $name,
                'price'=>$price,
                'details' => $details,
                'category_id' => $category_id,
                'created_at' => $created_at
            );

            // Push to "data"
            array_push($data, $product_item);
        }
        //set message
        $message = 'Get products successful';

    } else {
        // No product
        $message = 'No products to display';
    }
  }catch(Exception $e){
    $statusCode = 401;
    $message = 'Error getting Products.';
  }

  //return values


  echo json_encode(array(
      'status'  => $statusCode,
      'message' => $message,
      'data'    => $data
  ));
  

