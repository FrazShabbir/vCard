<?php

namespace Database\Seeders;

use App\Models\SocialPlatform;
use Illuminate\Database\Seeder;

class SocialPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialPlatform::updateOrCreate([
            'name' => 'Facebook',
            'link' => 'https://facebook.com',
            'icon' => 'fa-brands fa-facebook',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Twitter',
            'link' => 'fa-brands fa-x-twitter',
            'icon' => 'fab fa-twitter',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Instagram',
            'link' => 'https://instagram.com',
            'icon' => 'fa-brands fa-instagram',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'LinkedIn',
            'link' => 'https://linkedin.com',
            'icon' => 'fa-brands fa-linkedin',
        ]);

        SocialPlatform::updateOrCreate([
            'name' => 'YouTube',
            'link' => 'https://youtube.com',
            'icon' => 'fa-brands fa-youtube',
        ]);

        SocialPlatform::updateOrCreate([
            'name' => 'WhatsApp',
            'link' => 'https://whatsapp.com',
            'icon' => 'fa-brands fa-whatsapp',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Messenger',
            'link' => 'https://messenger.com',
            'icon' => 'fa-brands fa-facebook-messenger',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Custom',
            'link' => 'https://messenger.com',
            'icon' => 'fa-solid fa-link',
        ]);
    }
}
