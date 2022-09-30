<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
            ]
        );

        Role::firstOrCreate([
            'name' => 'users',
            'display_name' => 'Users',
        ]);

        //create or get permission
        $permissions = [];
        foreach ($this->getPermissions() as $permission) {
            $p = Permission::firstOrCreate(
                array('name' => $permission['name']),
                (array) $permission
            );

            $permissions[] = $p->id;
        }

        // assign or update admin roles
        $adminRole->syncPermissions($permissions);
    }

    /**
     * Predefined permission
     * @return array
     */

    public function getPermissions()
    {
        return array(
            array(
                'name' => 'permission.update',
                'display_name' => 'Permission Update'
            ),
            array(
                'name' => 'role.viewAny',
                'display_name' => 'Role list'
            ),
            array(
                'name' => 'role.create',
                'display_name' => 'Role add'
            ),
            array(
                'name' => 'role.update',
                'display_name' => 'Role Update'
            ),
            array(
                'name' => 'role.delete',
                'display_name' => 'Role Delete'
            ),
            array(
                'name' => 'activity.viewAny',
                'display_name' => 'Activity List'
            ),
            array(
                'name' => 'dashboard.viewAny',
                'display_name' => 'Dashboard Show'
            ),
            array(
                'name' => 'profile.show',
                'display_name' => 'Profile Show'
            ),
            array(
                'name' => 'profile.update',
                'display_name' => 'Profile Update'
            ),
            array(
                'name' => 'profile.activity',
                'display_name' => 'Profile Activities'
            ),
            array(
                'name' => 'profile.session',
                'display_name' => 'Profile Session'
            ),
            array(
                'name' => 'setting.update',
                'display_name' => 'Update Setting'
            ),
            // user
            array(
                'name' => 'user.viewAny',
                'display_name' => 'User List'
            ),
            array(
                'name' => 'user.create',
                'display_name' => 'User Add'
            ),
            array(
                'name' => 'user.view',
                'display_name' => 'User Show'
            ),
            array(
                'name' => 'user.update',
                'display_name' => 'user Update'
            ),
            array(
                'name' => 'user.delete',
                'display_name' => 'User Delete'
            ),

            // Theme
            array(
                'name' => 'theme.viewAny',
                'display_name' => 'Theme List'
            ),
            array(
                'name' => 'theme.update',
                'display_name' => 'Theme Add'
            ),

            //////////////////////////////////////////////
            //////////////              //////////////////
            //////////////////////////////////////////////

        );
    }
}
