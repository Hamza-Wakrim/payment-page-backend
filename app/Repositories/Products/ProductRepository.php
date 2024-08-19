<?php

namespace App\Repositories\Products;

use App\Services\ZohoService;

class ProductRepository
{
    protected $zohoService;

    public function __construct(ZohoService $zohoService)
    {
        $this->zohoService = $zohoService;
    }

    public function getAllProducts()
    {
        return $this->zohoService->getProducts();
    }
}
