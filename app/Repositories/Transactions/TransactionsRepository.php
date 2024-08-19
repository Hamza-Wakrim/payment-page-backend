<?php

namespace App\Repositories\Transactions;

use App\Models\Customer;
use App\Repositories\Customers\CustomerRepository;
use App\Services\ZohoService;
use Illuminate\Support\Arr;

class TransactionsRepository
{
    public function __construct(
        private readonly ZohoService $zohoService,
        private readonly CustomerRepository $customerRepository
    )
    {
    }

    public function createHostedPage($data = []): ?array
    {
        return $this->zohoService->createHostedPage($data);
    }
}
