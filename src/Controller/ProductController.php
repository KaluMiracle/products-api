<?php
    namespace Source\Controller;

    use Source\Model\FurnitureModel;
    use Source\Model\ProductModel;
    class ProductController  {
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

        // function to store furniture in the database
        public function storeFurniture() {
            //instantiate Product model

            $furnitureModel = new FurnitureModel();
            
            //create a product and save

            return $furnitureModel->create(
                $this->sku,
                $this->category_id,
                $this->name,
                $this->details,
                $this->price,
            );
        } 

        // function to store dvd in the database
        public function storeDvd() {
            //instantiate Product model

            $furnitureModel = new FurnitureModel();
            
            //create a product and save

            return $furnitureModel->create(
                $this->sku,
                $this->category_id,
                $this->name,
                $this->details,
                $this->price,
            );
        } 

        // function to store book in the database

        public function storeBook() {
            //instantiate Product model

            $furnitureModel = new FurnitureModel();
            
            //create a product and save

            return $furnitureModel->create(
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