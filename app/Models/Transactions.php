<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    public const TABLE = 'transactions';
    public const ID = 'id';
    public const CUSTOMER_ID = 'customer_id';
    public const ZOHO_SUBSCRIPTION_ID ='zoho_subscription_id';
    public const HOSTED_PAGE_ID = 'hosted_page_id';
    public const PLAN_CODE = 'plan_code';
    public const PRICE = 'price';
    public const STATUS ='status';
    public const CUSTOMER = 'customer';
    public const PLAN = 'plan';

    public const STATUS_PAID = 1;
    public const STATUS_FAILED = 2;
    public const STATUS_CANCELLED = 3;
    public const STATUS_REFUNDED = 4;
    public const STATUS_EXPIRED = 5;

    protected $table = self::TABLE;

    protected $fillable = [
        self::CUSTOMER_ID,
        self::ZOHO_SUBSCRIPTION_ID,
        self::HOSTED_PAGE_ID,
        self::PLAN_CODE,
        self::PRICE,
        self::STATUS
    ];

    protected $cast = [
        self::STATUS => 'integer',
        self::CUSTOMER_ID => 'integer',
    ];

    public function getId(): ?int
    {
        return $this->getAttribute(self::ID);
    }

    public function getCustomerId(): ?int
    {
        return $this->getAttribute(self::CUSTOMER_ID);
    }

    public function getZohoSubscriptionId(): ?string
    {
        return $this->getAttribute(self::ZOHO_SUBSCRIPTION_ID);
    }

    public function getHostedPageId(): ?string
    {
        return $this->getAttribute(self::HOSTED_PAGE_ID);
    }

    public function getPlanCode(): ?int
    {
        return $this->getAttribute(self::PLAN_CODE);
    }

    public function getAmount(): ?float
    {
        return $this->getAttribute(self::AMOUNT);
    }

    public function getStatus(): ?int
    {
        return $this->getAttribute(self::STATUS);
    }
}
