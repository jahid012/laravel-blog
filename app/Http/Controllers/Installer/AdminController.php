<?php

namespace App\Http\Controllers\Installer;

defined('STDIN') or define('STDIN', fopen("php://stdin", "r"));

use App\Support\Installer;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return redirect()->route('install.requirements')
                ->withErrors(['database_connection' => trans('installer_messages.database.error.connection')]);
        }

        try {
            if (DB::table('migrations')->count()  < 0) {
                return redirect()->route('install.installationShowForm')
                    ->withErrors([
                        'database_not_empty' => trans('installer_messages.database.error.database_not_empty', ['name' => DB::connection()->getDatabaseName()]),
                    ]);
            }
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }

        $user = User::where('email', $request->email)->first();
        return view('installer.admin', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return redirect()->route('install.requirements')
                ->withErrors(['database_connection' => trans('installer_messages.database.error.connection')]);
        }

        try {
            if (DB::table('migrations')->count()  < 0) {
                return redirect()->route('install.installationShowForm')
                    ->withErrors([
                        'database_not_empty' => trans('installer_messages.database.error.database_not_empty', ['name' => DB::connection()->getDatabaseName()]),
                    ]);
            }
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }

        $request->validate([
            'username'    => 'required|min:5|max:255',
            'email'       => 'required|email',
            'password'    => 'required|min:8|max:255',
        ]);

        // admin role
        $role = Role::findByName('admin');
        // remove duplicate
        $users = User::where('username', $request->username)->get();
        foreach ($users as $user) {
            if ($user != null && $user->email != $request->email) {
                $user->delete();
            }
        }

        // create user
        $user = User::updateOrCreate(
            array(
                'email' => $request->email,
            ),
            array(
                'id' => Str::uuid()->toString(),
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $role->getId(),
                'email_verified_at' => now(),
                'avatar' => Installer::get_site_url("/uploads/2021/11/avatar.png"),
            )
        );
        sleep(1);
        return redirect()->route('install.final');
    }

}
