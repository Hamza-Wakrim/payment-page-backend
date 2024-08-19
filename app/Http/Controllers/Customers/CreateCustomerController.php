<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Repositories\Customers\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateCustomerController extends Controller
{
    public function __construct(
        private readonly CustomerRepository $customerRepository
    ) {
    }

    public function __invoke(Request $request)
    {
        try{
            //get all products from zoho
            $data = $request->all();
            $customer = $this->customerRepository->createCustomer($data);

            return response()->json(['data' => $customer], 200);
        }catch(Throwable $e){
            Log::error('Retrieve Products failed: ' . $e->getMessage());
            Log::error('trase: ' . json_encode($e->getTrace(), true));

            throw $e;
        }
    }
}
