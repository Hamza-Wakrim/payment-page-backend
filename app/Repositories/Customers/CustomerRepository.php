<?php

namespace App\Repositories\Customers;

use App\Models\Customer;
use App\Services\ZohoService;

class CustomerRepository
{
    protected $zohoService;

    public function __construct(ZohoService $zohoService)
    {
        $this->zohoService = $zohoService;
    }

    public function createCustomer($data): ?Array
    {
        return $this->zohoService->createCustomer($data);
    }

    public function findById($id): ?Customer
    {
        return Customer::find($id);
    }
}
