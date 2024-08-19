<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Config
 *
 * @property string|null $version
 * @property int|null $organization_id
 * @property string|null $expires_in
 *
 * @package App\Models
 */
class Config extends Model
{
    use HasFactory;

    public const TABLE = 'config';
    public const VERSION ='version';
    public const ORGANIZATION_ID = 'organization_id';
    public const EXPIRES_IN = 'expires_in';
    public const DATA = 'data';

    protected $table = self::TABLE;

    protected $fillable = [
        self::VERSION,
        self::ORGANIZATION_ID,
        self::EXPIRES_IN,
        self::DATA,
    ];

    protected $casts = [
        self::DATA => 'json'
    ];

    public function getData()
    {
        return $this->getAttribute(self::DATA);
    }

    public function getOrganizationId(): ?int
    {
        return $this->getAttribute(self::ORGANIZATION_ID);
    }

    public function getExpiresIn(): ?string
    {
        return $this->getAttribute(self::EXPIRES_IN);
    }
}
