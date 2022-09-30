<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * @var Role
     */
    private $roles;

    /**
     * UsersController constructor.
     * @param Role $roles
     */
    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('role.viewAny');
        $data = $this->roles->paginate(15);
        return view('role.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('role.create');
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('role.create');
        $request->validate([
            'name' => 'unique:roles',
            'display_name' => 'unique:roles',
        ]);

        $this->roles->create([
            'name' => Str::studly($request->name),
            'display_name' => $request->display_name,
        ]);

        return redirect()->route('roles.index')
            ->withSuccess(__('Role created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('role.update');
        $role = Role::where('id', $id)->first();
        $permissions = Permission::all();
        return view('role.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('role.update');
        $data = $this->roles->findOrFail($id);
        return view('role.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('role.update');
        $request->validate([
            'name' => 'unique:roles,name,'. $id. ',id',
            'display_name' => 'unique:roles,display_name,'. $id. ',id',
        ]);

        $this->roles->where('id', $id)->update([
            'name' => Str::studly($request->name),
            'display_name' => $request->display_name,
        ]);

        return redirect()->route('roles.index')
            ->withSuccess(__('Role Update successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id )
    {
        $this->authorize('role.delete');
        $role = $this->roles->findOrFail($id);

        if (!$role->isRemovable() ) {
            return back()->withError(__("[{$role->name}] is Primary Role. You can't deleted it."));
        }

        $user->switchUsersRole($role->id);
        $role->delete();
        Cache::flush();

        return redirect()->route('roles.index')
            ->withSuccess(__('Role deleted successfully.'));
    }
}
