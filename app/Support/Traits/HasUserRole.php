<?php

namespace App\Support\Traits;
use App\Models\Role;

trait HasUserRole
{
    /**
     * Get the role that owns the User.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Assign the given role to the model.
     *
     * @param int|string $role
     *
     * @return $this
     */
    public function assignRole($roleId)
    {
        if(is_string($roleId)){

        }
        return $this->forceFill([
            'role_id' => $roleId
        ])->save();
    }

    /**
     * Check if user has specified role.
     *
     * @param string|int|array $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->name === $role;
        }

        if (is_int($role)) {
            return $this->role->id === $role;
        }

        if (is_array($role)) {
            foreach ($role as $value) {
                if ($this->hasRole($value)) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * @param int $roleId
     * @return boolean
     */
    public function switchUsersRole( $roleId )
    {
        $primaryRole = Role::primaryRole();

        return self::where('role_id', $roleId)
            ->update(['role_id' => $primaryRole->id ]);
    }

    /**
     * get user role name
     * 
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->role()->name;
    }
}