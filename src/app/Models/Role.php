<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Relationships\RoleRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use RoleRelationship, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'manager'
    ];

    /**
     * Retorna as permissões disponiveis para o perfil
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('id', function($query) {
            $query->select('permission_id');
            $query->from('permission_role');
            $query->where('role_id', $this->id);
        })->where(function ($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('name', 'LIKE', "%{$filter}%");
            }
        })->paginate();

        return $permissions;
    }
}
