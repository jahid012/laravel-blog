<?php

namespace Plugins\Price\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Price\Models\Price;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data() as $price) {
            Price::updateOrCreate([
                'icon'      => $price['icon'],
                'name'      => $price['name'],
                'price'     => $price['price'],
                'info'      => $price['info'],
                'link'      => $price['link'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'icon' => 'icofont-package',
                'name' => ' Design Package ',
                'price' => '$99',
                'info' => '<ul><li><i class="icofont-check"></i> Business Hosting</li><li><i class="icofont-check"></i>Branding &amp; Illustration </li><li><i class="icofont-check"></i>Social Media Banner</li><li><i class="icofont-check"></i>Web UI</li></ul>',
                'link' => '#',
            ],
            [
                'icon' => 'icofont-newspaper',
                'name' => ' Advance ',
                'price' => '$99',
                'info' => '<ul><li><i class="icofont-check"></i>PSD to Wordpress</li><li><i class="icofont-check"></i>Web Design</li><li><i class="icofont-check"></i>Web Development</li><li><i class="icofont-check"></i>10 hours of support</li></ul>',
                'link' => '#',
            ],
            [
                'icon' => 'icofont-license',
                'name' => '  Ecommerce Solution  ',
                'price' => '$799',
                'info' => '<ul><li><i class="icofont-check"></i>Woocommerce Store</li><li><i class="icofont-check"></i>Ecommerce Web</li><li><i class="icofont-check"></i>Data Management</li><li><i class="icofont-check"></i>PSD to Woocommerce</li></ul>',
                'link' => '#',
            ],

        ];
    }
}
