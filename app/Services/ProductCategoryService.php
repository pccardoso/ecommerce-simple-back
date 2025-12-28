<?php

    namespace App\Services;

    use App\Repository\ProductCategoryRepository;

    class ProductCategoryService {

        public function __construct(
            protected ProductCategoryRepository $repository
        ){}

        public function createCategory(array $data){

            return $this->repository->create($data);

        }

        public function indexCategory(){
            return $this->repository->all();
        }

    }