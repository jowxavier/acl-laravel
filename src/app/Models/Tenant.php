<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Relationships\TenantRelationship;

class Tenant extends Model
{
    use TenantScope, TenantRelationship, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj',
        'company',
        'email',
        'logo',
        'active',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'subscription',
        'expires_at',
    ];
}
