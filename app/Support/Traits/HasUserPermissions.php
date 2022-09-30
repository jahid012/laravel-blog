<?php

namespace App\Support\Traits;

trait HasUserPermissions
{
    /**
     * Checks if the role has a permission by its name.
     *
     * @param string $name Permission name.
     * @return bool
     */
    public function hasPermission($permission, $allRequired = true)
    {
        $permission = (array) $permission;

        return $allRequired
            ? $this->hasAllPermissions($permission)
            : $this->hasAtLeastOnePermission($permission);
    }

    /**
     * Check if user has all provided permissions
     * (translates to AND logic between permissions).
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAllPermissions(array $permissions)
    {
        $availablePermissions = $this->role->cachedPermissions()->pluck('name')->toArray();

        foreach ($permissions as $perm) {
            if (! in_array($perm, $availablePermissions, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if user has at least one of provided permissions
     * (translates to OR logic between permissions).
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions)
    {
        $availablePermissions = $this->role->cachedPermissions()->pluck('name')->toArray();

        foreach ($permissions as $perm) {
            if (in_array($perm, $availablePermissions, true)) {
                return true;
            }
        }

        return false;
    }


}