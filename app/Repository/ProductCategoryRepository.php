<?php

    namespace App\Repository;
    
    use App\Models\ProductCategory;

    class ProductCategoryRepository {

        public function create(array $data){

            return ProductCategory::create($data);

        }

        public function all(){
            return ProductCategory::all();
        }

    }