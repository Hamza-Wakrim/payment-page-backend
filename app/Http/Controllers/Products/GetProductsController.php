<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetProductsController extends Controller
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function __invoke()
    {
        try{
            //get all products from zoho
            $products = $this->productRepository->getAllProducts();

            return response()->json(['data' => $products], 200);
        }catch(Throwable $e){
            Log::error('Retrieve Products failed: ' . $e->getMessage());
            Log::error('trase: ' . json_encode($e->getTrace(), true));
            return response()->json(['error' => 'An error occurred while fetching products'], 500);
        }
    }
}
