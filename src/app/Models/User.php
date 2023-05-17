<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\Acl\UserAcl;
use App\Models\Traits\Scopes\UserScope;
use App\Models\Traits\Scopes\LocalScope;
use App\Models\Traits\Relationships\UserRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UserRelationship, LocalScope, UserScope, UserAcl, HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retorna os cargos disponiveis para o usuário
     */
    public function rolesAvailable($filter = null)
    {
        $users = Role::whereNotIn('id', function($query) {
            $query->select('role_id');
            $query->from('role_user');
            $query->where('user_id', $this->id);
        })->where(function ($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('name', 'LIKE', "%{$filter}%");
            }
        })->paginate();

        return $users;
    }
}
