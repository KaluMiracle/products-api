<?php 
  namespace Model;
  require '../../config/Database.php';

  use Database\Database;

  class ProductModel extends Database {
    //table name
    private $table = 'product';
    
    //contructor

    public function __construct() {
      parent::__construct();
    }

    // function too get products
    public function read() {

      // select query
      $query = 'SELECT  
                  p.sku, 
                  p.category_id, p.name, 
                  p.price, p.details, 
                  p.created_at
                FROM ' . $this->table . ' p
                ORDER BY
                  p.created_at DESC';
      
      //execute query

      $stmt= $this->conn->query($query);

      return $stmt ;
    }

    

    // function to create product

    public function create($sku, $category_id, $name, $price, $details) {

      // insert query
      $query = 'INSERT INTO ' . $this->table . ' (sku, category_id, name, price, details) VALUE (?, ?, ?, ?, ?)';
      
      // Clean data
      $sku = htmlspecialchars(strip_tags($sku));
      $name = htmlspecialchars(strip_tags($name));
      $details = htmlspecialchars(strip_tags($details));
      $price = htmlspecialchars(strip_tags($price));
      $category_id = htmlspecialchars(strip_tags($category_id));

      //prepare query
      $stmt = $this->conn->prepare($query);

      //bind data
      $stmt->bind_param('sssis', $sku, $category_id, $name, $price, $details);

      // // Execute query
      if($stmt->execute()) {
        return true;
      }

      return false;
      
    }

    // function to delete product
    public function delete($sku) {
          // delete query
          $query = 'DELETE FROM ' . $this->table . ' WHERE sku = ?';

          // prepare statement
          $stmt = $this->conn->prepare($query);

          // clean data
          $sku = htmlspecialchars(strip_tags($sku));

          // bind data
          $stmt->bind_param('s', $sku);

          // execute query
          if($stmt->execute()) {
            return true;
          }

          return false;
    }
    
  }