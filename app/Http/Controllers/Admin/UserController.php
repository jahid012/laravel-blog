<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\User\Banned;
use App\Events\User\Deleted;
use App\Events\User\Unconfirmed;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $users;

    /**
     * UsersController constructor.
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user.viewAny');

        $users = $this->users->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('user.create');

        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('user.create');

        $request->validate([
            'username' => 'nullable|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'birthday' => 'required|date',
            'status' => 'required|in:active,banned,unconfirmed',
            'role_id' => 'required',
        ]);

        $this->users->create([
            'username' => Str::studly($request->username),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'status' => $request->status,
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('users.index')->withSuccess('User created successfully.⚡️');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $this->authorize('user.view');

        $user = $this->users->findOrFail($id);
        $ativities = Activity::where('user_id', $user->id)->paginate(15);
        return view('users.show', compact('user', 'ativities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('user.update');
        $user = $this->users->findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('user.update');

        $request->validate([
            'username' => 'required|unique:users,username,'. $id,
            'email' => 'required|unique:users,email,'. $id,
            'phone' => 'required|unique:users,phone,'. $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'birthday' => 'required|date',
            'status' => 'required|in:active,banned,unconfirmed',
        ]);

        $this->users->where('id', $id)->update([
            'username' => Str::studly($request->username),
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'status' => $request->status,
            'role_id' => $request->role_id,
        ]);

        $user = $this->users->find($id);

        if($request->input('status') == 'banned'){
            event(new Banned( $user ));
        }

        if($request->input('status') == 'unconfirmed'){
            event(new Unconfirmed( $user ));
        }

        return back()->withInput($request->all())->withSuccess('User info update successfully.⚡️');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request, $id)
    {
        $this->authorize('user.update');

        $request->validate([
            'password' => 'required|min:6|max:50',
        ]);

        $data = $request->only(['password']);
        $this->users->where('id', $id)->update($data);

        return back()->withInput($request->all())->withSuccess('User created successfully.⚡️');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('user.delete');

        $user = $this->users->findOrFail($id);
        if($user != null){
            $user->delete();
            event(new Deleted($user));
        }
        return redirect()->route('users.index')->withSuccess('User Deleted successfully.⚡️');
    }
}
