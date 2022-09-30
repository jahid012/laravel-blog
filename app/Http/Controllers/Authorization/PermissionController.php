<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{
     /**
     * @var Role
     */
    private $roles;

    /**
     * @var Permission
     */
    private $permissions;

    /**
     * PermissionsController constructor.
     * @param Role $roles
     * @param Permission $permissions
     */
    public function __construct(Role $roles, Permission $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('permission.update');

        return view('permission.index', [
            'roles' => $this->roles->all(),
            'permissions' => $this->permissions->all()
        ]);
    }

    /**
     * Update permissions for each role.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->authorize('permission.update');

        $roles = $request->input('roles');
        $allRoles = $this->roles->pluck('name', 'id');

        foreach ($allRoles as $roleId => $roleName ) {
            $permissions = Arr::get($roles, $roleId, []);
            $this->roles->updatePermissions($roleId, $permissions);
        }
        // event(new PermissionsUpdated);
        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }


    /**
     * Update permissions for each role.
     *
     * @param Request $request
     * @return mixed
     */
    public function updateByRoleName(Request $request, $role_id)
    {
        $this->authorize('permission.update');
        $role =  Role::findOrFail($role_id);

        $this->roles->updatePermissions($role->id, $request->permissions);
        // event(new PermissionsUpdated);
        return back()->withSuccess(__('Permission updated successfully.'));
    }


}
