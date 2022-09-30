<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenusTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // create admin menu
        $menu = Menu::firstOrNew([
            'name'     => 'admin',
        ]);
        if (!$menu->exists) {
            $menu->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Dashboard'),
            'url'     => route('dashboard'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-home',
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Pages'),
            'url'     => route('pages.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-feather',
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Media'),
            'url'     => route('media.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-image',
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }

        //parentMenuItem
        $userMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Users'),
            'url'     => '#',
        ]);
        if (!$userMenuItem->exists) {
            $userMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-users',
                'parent_id'  => null,
                'order'      => 4,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Users'),
            'url'     => route('users.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $userMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Roles'),
            'url'     => route('roles.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $userMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Permissions'),
            'url'     => route('permissions.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $userMenuItem->id,
                'order'      => 2,
            ])->save();
        }

        //Appearance
        $appearanceMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Appearance'),
            'url'     => '#',
        ]);
        if (!$appearanceMenuItem->exists) {
            $appearanceMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-airplay',
                'parent_id'  => null,
                'order'      => 5,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Themes'),
            'url'     => route('themes.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $appearanceMenuItem->id,
                'order'      => 10,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Theme Options'),
            'url'     => route('themes.options'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $appearanceMenuItem->id,
                'order'      => 11,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Languages'),
            'url'     => route('themes.languages.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $appearanceMenuItem->id,
                'order'      => 12,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Menus'),
            'url'     => route('menus.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'parent_id'  => $appearanceMenuItem->id,
                'order'      => 13,
            ])->save();
        }
        // plugins

        //Appearance
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Plugins'),
            'url'     => route('plugins.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-cpu',
                'parent_id'  => null,
                'order'      => 7,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Activities'),
            'url'     => route('activity.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-activity',
                'parent_id'  => null,
                'order'      => 20,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Settings'),
            'url'     => route('settings.index'),
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'feather-settings',
                'parent_id'  => null,
                'order'      => 30,
            ])->save();
        }
    }
}

