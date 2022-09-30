<?php

namespace Wokoya\Support\Seeders;

use App\Models\ThemeOption;
use Illuminate\Database\Seeder;

class ThemeOptionTableSeeder extends Seeder
{

    /**
     * Seed the application"s database.
     *
     * @return void
     */
    public function run()
    {
        // set home and blog page
        foreach ($this->data() as $key => $value) {
            ThemeOption::updateOrCreate([
                "theme_name"    => config('cms.theme'),
                "key"           => $key,
                "lang"          => app()->currentLocale(),
            ],[
                "value"         => $value,
            ]);
        }
    }

    public function data()
    {
        $theme_name = config('cms.theme');
        $data = [
            // image
            "site_logo" => asset("themes/{$theme_name}/assets/img/profile-avatar.png"),
            "site_favicon" => asset("themes/{$theme_name}/assets/img/favicon.png"),
            "hero_image" => asset("themes/{$theme_name}/assets/img/header-bg.jpg"),
            "about_image" => asset("themes/{$theme_name}/assets/img/about-me.png"),

            //site
            "site_name" => "Copyright @ Wokoya",
            "site_title" => "Wokoya | Laravel CMS",
            "title_separate" => 1,
            "site_description" => "Laravel CMS",
            "site_address" => " 208 Maliha Square, Dubai, UAE",
            "site_email" => "support@ducor.net",
            "site_phone" => "+123 456 7890",
            "site_copyright" => "all rights reserved by ducor.net 2021.",

            // seo
            "seo_title" => "Wokoya | Laravel CMS",
            "seo_description" => "Laravel CMS",
            "seo_ogimage" => asset("themes/{$theme_name}/assets/img/seo_image.png"),

            //socials
            "social_facebook" => "#",
            "social_twitter" => "#",
            "social_youtube" => "#",

            //footer
            "site_socials" => '<li>
                                    <a href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-dribbble"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-behance"></i>
                                    </a>
                                </li>',
            "site_footer_links" => '<a href="#">Faqs /</a>
                                    <a href="#">privacy policy /</a>
                                    <a href="#">services</a>',

            // google
            "google_map" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.9884675458907!2d55.47781281501099!3d25.270973383861868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5fa631c9b3eb%3A0x8e1767fbdbb6f44d!2sMaliha%20Rd%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sbd!4v1631169609660!5m2!1sen!2sbd",
            "google_analytic" => null,
            "disqus_shortname" => "",
        ];

        if($theme_name == 'wokoya-iconbar'){
            $data['site_logo'] = asset("themes/{$theme_name}/assets/img/logo.png");
            $data['site_name'] = '@ Wokoya';
        }

        if($theme_name == 'wokoya-topbar'){
            $data['site_logo'] = asset("themes/{$theme_name}/assets/img/logo.png");
        }

        return $data;
    }

}
