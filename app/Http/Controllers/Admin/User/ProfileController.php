<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * ProfileController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->authorize('profile.show');

        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize('profile.update');
        $user = auth()->user();
        $roles = Role::all();
        return view('profile.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('profile.update');
        $id = auth()->id();
        $request->validate([
            'username' => 'required|unique:users,username,'. $id,
            'email' => 'required|unique:users,email,'. $id,
            'phone' => 'nullable|unique:users,phone,'. $id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'birthday' => 'required|date',
        ]);

        $this->user->where('id', $id)->update($request->except(['_token']));

        return back()->withInput($request->all())->withSuccess('User created successfully.⚡️');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request)
    {
        $this->authorize('profile.update');
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|max:50',
            'new_confirm_password' => 'same:new_password',
        ]);

        $this->user->where('id', auth()->id() )->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->withSuccess('Password Change successfull');
    }
}
