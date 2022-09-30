<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:admin {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make sure there is a user with the admin role that has all of the necessary permissions.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = $this->getUser();

        // the user not returned
        if (!$user) {
            $this->info('Invalid request');
            return Command::INVALID;
        }

        $this->info('Creating admin account');
        return Command::SUCCESS;
    }


    /**
     * Get the administrator role, create it if it does not exists.
     *
     * @return mixed
     */
    protected function getAdministratorRole()
    {
        $role = Role::firstOrNew([
            'name' => 'admin',
        ]);

        if (!$role->exists) {
            $role->save();
        }

        return $role;
    }

    /**
     * Get User
     * 
     */
    protected function getUser()
    {
        $email      = $this->argument('email');
        $password   = $this->argument('password');

        if($email == null){
            $email = $this->ask("Enter the admin Email");
        }

        if($password == null){
            $password = $this->ask("Enter the admin Password");
        }

        $role = $this->getAdministratorRole();
        $user = User::where('email', $email)->first();

        if($user != null){
            $user = $user->forceFill([
                'password' => bcrypt($password),
                'role_id' => $role->id,
            ])->save();
        }

        if($user == null){
            $user = User::create([
                'username' => uniqid(),
                'email'    => $email,
                'password' => bcrypt($password),
                'role_id' => $role->id,
            ]);
        }

        return $user;
    }
}
