<?php

namespace Plugins\Service\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Service\Models\Service;

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
            Service::updateOrCreate([
                'icon'          => $price['icon'],
                'name'          => $price['name'],
                'description'   => $price['description']
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'icon' => 'icofont-vector-path',
                'name' => 'Branding',
                'description' => '<ul><li>Logo design</li><li>Brand Guide</li><li>Brand Printing</li></ul>',
            ],
            [
                'icon' => 'icofont-ui-browser',
                'name' => 'Print Design',
                'description' => '<ul><li>Business Card</li><li>Brochure</li><li>Magazine</li></ul>',
            ],
            [
                'icon' => 'icofont-ui-theme',
                'name' => 'Wordpress Ninja',
                'description' => '<ul><li>PSD to WP</li><li>Woocommerce</li><li>Speed Optimization</li></ul>',
            ],
            [
                'icon' => 'icofont-ship-wheel',
                'name' => 'Graphic Design',
                'description' => '<ul><li>Package Design</li><li>Email Signature</li><li>Social Media Banner</li></ul>',
            ],
            [
                'icon' => 'icofont-ssl-security',
                'name' => 'Cyber Security',
                'description' => '<ul><li>Ethical Hacking</li><li>Security Analysis</li><li>Remove Malware</li></ul>',
            ],
            [
                'icon' => 'icofont-bulb-alt',
                'name' => 'Web Development',
                'description' => '<ul><li>React JS</li><li>PSD to HTML</li><li>Javascript</li></ul>',
            ],

        ];
    }
}
