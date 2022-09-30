<?php

namespace Wokoya\Support\Seeders;

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
        $adminRole = Role::where('name', 'admin')->first();

        //create or get permission
        $permissions = Permission::select('id')->get()->pluck('id')->toArray();
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
                'name' => 'posts.viewAny',
                'display_name' => 'Post list'
            ),
            array(
                'name' => 'posts.create',
                'display_name' => 'Post add'
            ),
            array(
                'name' => 'posts.update',
                'display_name' => 'Post Update'
            ),
            array(
                'name' => 'posts.delete',
                'display_name' => 'Post Delete'
            ),
            //

            array(
                'name' => 'categories.viewAny',
                'display_name' => 'Category list'
            ),
            array(
                'name' => 'categories.create',
                'display_name' => 'Category add'
            ),
            array(
                'name' => 'categories.update',
                'display_name' => 'Category Update'
            ),
            array(
                'name' => 'categories.delete',
                'display_name' => 'Category Delete'
            ),
            //

            array(
                'name' => 'contacts.viewAny',
                'display_name' => 'Contact list'
            ),
            array(
                'name' => 'contacts.create',
                'display_name' => 'Contact add'
            ),
            array(
                'name' => 'contacts.update',
                'display_name' => 'Contact Update'
            ),
            array(
                'name' => 'contacts.delete',
                'display_name' => 'Contact Delete'
            ),
            //

            array(
                'name' => 'faqs.viewAny',
                'display_name' => 'Faq list'
            ),
            array(
                'name' => 'faqs.create',
                'display_name' => 'Faq add'
            ),
            array(
                'name' => 'faqs.update',
                'display_name' => 'Faq Update'
            ),
            array(
                'name' => 'faqs.delete',
                'display_name' => 'Faq Delete'
            ),
            //

            array(
                'name' => 'portfolios.viewAny',
                'display_name' => 'Portfolio list'
            ),
            array(
                'name' => 'portfolios.create',
                'display_name' => 'Portfolio add'
            ),
            array(
                'name' => 'portfolios.update',
                'display_name' => 'Portfolio Update'
            ),
            array(
                'name' => 'portfolios.delete',
                'display_name' => 'Portfolio Delete'
            ),
            //

            array(
                'name' => 'prices.viewAny',
                'display_name' => 'Price list'
            ),
            array(
                'name' => 'prices.create',
                'display_name' => 'Price add'
            ),
            array(
                'name' => 'prices.update',
                'display_name' => 'Price Update'
            ),
            array(
                'name' => 'prices.delete',
                'display_name' => 'Price Delete'
            ),
            //

            array(
                'name' => 'qualifications.viewAny',
                'display_name' => 'Qualification list'
            ),
            array(
                'name' => 'qualifications.create',
                'display_name' => 'Qualification add'
            ),
            array(
                'name' => 'qualifications.update',
                'display_name' => 'Qualification Update'
            ),
            array(
                'name' => 'qualifications.delete',
                'display_name' => 'Qualification Delete'
            ),
            //

            array(
                'name' => 'services.viewAny',
                'display_name' => 'Service list'
            ),
            array(
                'name' => 'services.create',
                'display_name' => 'Service add'
            ),
            array(
                'name' => 'services.update',
                'display_name' => 'Service Update'
            ),
            array(
                'name' => 'services.delete',
                'display_name' => 'Service Delete'
            ),
            //

            array(
                'name' => 'skills.viewAny',
                'display_name' => 'Skill list'
            ),
            array(
                'name' => 'skills.create',
                'display_name' => 'Skill add'
            ),
            array(
                'name' => 'skills.update',
                'display_name' => 'Skill Update'
            ),
            array(
                'name' => 'skills.delete',
                'display_name' => 'Skill Delete'
            ),
            //

            array(
                'name' => 'testimonials.viewAny',
                'display_name' => 'Testimonial list'
            ),
            array(
                'name' => 'testimonials.create',
                'display_name' => 'Testimonial add'
            ),
            array(
                'name' => 'testimonials.update',
                'display_name' => 'Testimonial Update'
            ),
            array(
                'name' => 'testimonials.delete',
                'display_name' => 'Testimonial Delete'
            ),
            //


        );
    }
}
