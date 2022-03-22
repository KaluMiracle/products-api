<?php 
  namespace Source\Model;

  use Source\Config\Database;

  class ProductModel extends Database {
    //table name
    protected $table = 'product';
    
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