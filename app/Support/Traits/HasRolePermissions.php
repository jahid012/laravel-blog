<?php

namespace App\Support\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

trait HasRolePermissions
{
    /**
     * Checks if the role has a permission by its name.
     *
     * @param string $name Permission name.
     * @return bool
     */
    public function hasPermissionTo($name)
    {
        $perms = $this->cachedPermissions()->pluck('name')->toArray();

        return in_array($name, $perms, true);
    }

    /**
     * @param int $roleId
     * @param array $permissions
     * 
     * @return void
     */
    public function updatePermissions($roleId, array $permissions)
    {
        $role = self::find($roleId);
        $role->syncPermissions($permissions);
    }

    /**
     * Get cached permissions for this role.
     * @return mixed
     */
    public function cachedPermissions()
    {
        return Cache::remember($this->getCacheKey(), Config::get('cache.ttl'), function () {
            return $this->permissions()->get();
        });
    }


    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function givePermissionsTo($permissions)
    {
        foreach ($permissions as $permission) {
            $this->givePermissionTo($permission);
        }
    }

    /**
     * Attach permission to current role.
     *
     * @param string|array $permission
     *
     * @return void
     */
    public function givePermissionTo($permissions)
    {
        if(is_string($permissions)){
            $this->permissions()->attach($permissions);
        }

        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                $this->givePermissionTo($permission);
            }
        }
        $this->flushCache();
    }

    /**
     * Detach permission from current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->detach($permission);

        $this->flushCache();
    }


    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    /**
     * Sync role permissions.
     * @param $permissions array Permission IDs.
     */
    public function syncPermissions(array $permissions)
    {
        $this->permissions()->sync($permissions);

        $this->flushCache();
    }

    /**
     * Get permissions cache key.
     * @return string
     */
    private function getCacheKey()
    {
        return 'permissions_for_role_'.$this->{$this->primaryKey};
    }

    /**
     * Flush cached permissions for this role.
     */
    private function flushCache()
    {
        Cache::forget($this->getCacheKey());
    }
}