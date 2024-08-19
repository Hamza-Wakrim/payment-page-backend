<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public const TABLE = 'customer';
    public const ID = 'id';
    public const DISPLAY_NAME = 'display_name';
    public const EMAIL = 'email';
    public const FIRSTNAME = 'first_name';
    public const LASTNAME = 'last_name';
    public const PHONE = 'phone';
    public const MOBILE = 'mobile';
    public const ADDRESS = 'address';
    public const ZIP = 'zip';
    public const COUNTRY = 'country';
    public const STATUS ='status';
    public const ZOHO_CUSTOMER_ID = 'zoho_customer_id';

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    public const STATUS_ARCHIVED = 2;
    public const STATUS_SUSPENDED = 5;
    public const STATUS_UNSUBSCRIBED = 6;

    protected $table = self::TABLE;
    protected $fillable = [
        self::EMAIL,
        self::FIRSTNAME,
        self::LASTNAME,
        self::PHONE,
        self::ADDRESS,
        self::ZIP,
        self::COUNTRY,
        self::STATUS,
        self::ZOHO_CUSTOMER_ID,
    ];


    public function getId() {
        return $this->getAttribute(self::ID);
    }

    public function getEmail() {
        return $this->getAttribute(self::EMAIL);
    }

    public function getFirstName() {
        return $this->getAttribute(self::FIRSTNAME);
    }

    public function getLastName() {
        return $this->getAttribute(self::LASTNAME);
    }

    public function getPhone() {
        return $this->getAttribute(self::PHONE);
    }

    public function getMobile() {
        return $this->getAttribute(self::MOBILE);
    }

    public function getAddress() {
        return $this->getAttribute(self::ADDRESS);
    }

    public function getZip() {
        return $this->getAttribute(self::ZIP);
    }

    public function getCountry() {
        return $this->getAttribute(self::COUNTRY);
    }

    public function getStatus() {
        return $this->getAttribute(self::STATUS);
    }

    public function getZohoCustomerId() {
        return $this->getAttribute(self::ZOHO_CUSTOMER_ID);
    }
}
