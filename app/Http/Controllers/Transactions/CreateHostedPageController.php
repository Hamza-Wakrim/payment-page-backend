<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\Customers\CustomerRepository;
use App\Repositories\Transactions\TransactionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateHostedPageController extends Controller
{
    public function __construct(
        private readonly TransactionsRepository $transactionsRepository
    ) {
    }

    public function __invoke(Request $request)
    {
        try{
            //get all products from zoho
            $data = $request->all();
            $hostedPage = $this->transactionsRepository->createHostedPage($data);

            return response()->json(['data' => $hostedPage], 200);
        }catch(Throwable $e){
            Log::error('Retrieve creating hosted page: ' . $e->getMessage());
            Log::error('trase: ' . json_encode($e->getTrace(), true));

            throw $e;
        }
    }
}
