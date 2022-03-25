<?php
    namespace Source\Model;
    class BookModel extends ProductModel{


        public function __construct() {
            parent::__construct();
        }
        
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
    }