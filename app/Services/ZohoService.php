<?php

namespace App\Services;

use App\Models\Config;
use App\Models\Customer;
use App\Models\Transactions;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ZohoService
{
    protected $client;
    protected $baseUrl;

    protected $refreshUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('zoho.api_url');
        $this->refreshUrl = config('zoho.refresh_url');
    }

    public function createCustomer($data): ?array
    {
        try {
            $data = [
                Customer::DISPLAY_NAME => Arr::get($data, Customer::DISPLAY_NAME),
                Customer::LASTNAME     => Arr::get($data, Customer::LASTNAME),
                Customer::FIRSTNAME    => Arr::get($data, Customer::FIRSTNAME),
                Customer::EMAIL        => Arr::get($data, Customer::EMAIL),
                Customer::PHONE        => Arr::get($data, Customer::PHONE),
                Customer::MOBILE       => Arr::get($data, Customer::MOBILE),
            ];

            $response = Http::withHeaders(
                $this->getHeaders()
            )
                ->post($this->baseUrl . '/billing/v1/customers', $data);

            return [];
        } catch (Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function createHostedPage(Array $data): ?array
    {
        try {
            $zohoData = [
                Transactions::PLAN                  => [
                    Transactions::PLAN_CODE  => Arr::get($data['plan'], Transactions::PLAN_CODE),
                    Transactions::PRICE      => Arr::get($data['plan'], Transactions::PRICE)
                ],
                Transactions::CUSTOMER              => [
                    Customer::DISPLAY_NAME => Arr::get($data['customer'], Customer::FIRSTNAME),
                    Customer::EMAIL        => Arr::get($data['customer'], Customer::EMAIL),
                    Customer::PHONE        => Arr::get($data['customer'], Customer::PHONE),
                    Customer::MOBILE       => Arr::get($data['customer'], Customer::MOBILE),
                ]
            ];

            $response = Http::withHeaders(
                $this->getHeaders()
            )
                ->post($this->baseUrl . '/billing/v1/hostedpages/newsubscription', $zohoData);

            $responseZoho = json_decode(json_encode($response->json()), true);

            if($responseZoho['code'] === 0) {
                //save transaction to DB
                return $responseZoho;
            } else {
                $errorMessage = 'Transaction failed with status code: ' . $response->status();
                Log::warning('Transaction status from zoho: ' . $errorMessage);
            }
        } catch (Throwable $e) {
            throw new \Exception('Error creating hosted page');
        }
    }

    public function getProducts()
    {
        $cacheKey = 'billing_plans'; // Unique cache key for the list of plans

        // Check if the plans are already cached
        $plans = Cache::remember($cacheKey, 60 * 60, function () {
            $response = Http::withHeaders($this->getHeaders())
                            ->get($this->baseUrl . '/billing/v1/plans');

            return json_decode(json_encode($response->json()), true)['plans'];
        });

        return $plans;
    }

    public function findById(string $id)
    {
        try {
            $cacheKey = 'billing_plan_' . $id; // Unique cache key for each plan

            // Check if the plan is already cached
            $plan = Cache::remember($cacheKey, 60 * 60, function () use ($id) {
                $response = Http::withHeaders($this->getHeaders())
                                ->get($this->baseUrl . '/billing/v1/plans/' . $id);

                return json_decode(json_encode($response->json()), true)['plan'];
            });

            return $plan;
        } catch (Throwable $e) {
            throw new \Exception('Error getting product : '. $id);
        }
    }

    protected function getHeaders()
    {
        return [
            'Authorization'                           => 'Zoho-oauthtoken ' . $this->getAccessToken(),
            'Content-Type'                            => 'application/json',
            'X-com-zoho-subscriptions-organizationid' => '860147291'
        ];
    }

    protected function getAccessToken(): ?string
    {
        // Implement logic to retrieve and refresh access token if needed

        $config = Config::first();

        $response = Http::asForm()->post($this->refreshUrl . '/oauth/v2/token', [
            'refresh_token' =>  $config->getData()['refresh_token'],
            'client_id'     => config('zoho.client_id'),
            'client_secret' => config('zoho.client_secret'),
            'redirect_uri'  => 'http://127.0.0.1:8000/api/authZoho',
            'grant_type'    => config('zoho.grant_type'),
        ]);

        return json_decode(json_encode($response->json()), true)['access_token'];
    }
}
