<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Scopes\LocalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Relationships\CategoryRelationship;

class Category extends Model
{
    use TenantTrait, LocalScope, CategoryRelationship, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'url',
        'description'
    ];
}
