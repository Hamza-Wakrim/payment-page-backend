<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShowProductController extends Controller
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function __invoke($id)
    {
        try {
            //retriev product by plan_code from zoho
            $product = $this->productRepository->findById($id);

            return response()->json(['data' => $product], 200);
        } catch (Throwable $e){
            Log::error('Retrieve Product failed: ' . $e->getMessage());
            Log::error('trase: ' . json_encode($e->getTrace(), true));
            return response()->json(['error' => 'An error occurred while fetching Product'], 500);
        }
    }
}
