<?php
    namespace Controller;

    require '../../Model/ProductModel.php';

    use Model\ProductModel;

    class Product {
        // Product Properties
        public $sku;
        public $category_id;
        public $name;
        public $details;
        public $price;
        public $created_at;


        //contructor

        public function __construct($sku, $category_id, $name, $details, $price)
        {
            $this->sku = $sku;
            $this->category_id   = $category_id;
            $this->name = $name;
            $this->price = $price;
            $this->details = $details;
            
        }

        // function to store products in the database

        public function storeProduct() {
            //instantiate Product model

            $productsModel = new ProductModel();
            
            //create a product and save

            return $productsModel->create(
                $this->sku,
                $this->category_id,
                $this->name,
                $this->details,
                $this->price,
            );
        } 

        //function to get products from database

        public static function getProducts() {
            // instantiate Product Model

            $productsModel = new ProductModel();
            //get Products from database
            return $productsModel->read();
        } 

        // function to delete product from database

        public static function deleteProducts($sku) {
            // instantiate Product Model

            $productsModel = new ProductModel();

            //delete Product from database
            return $productsModel->delete($sku);
        } 
    } 