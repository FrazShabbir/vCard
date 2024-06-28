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
            'icon' => 'fab fa-facebook',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Twitter',
            'link' => 'https://twitter.com',
            'icon' => 'fab fa-twitter',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Instagram',
            'link' => 'https://instagram.com',
            'icon' => 'fab fa-instagram',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'LinkedIn',
            'link' => 'https://linkedin.com',
            'icon' => 'fab fa-linkedin',
        ]);

        SocialPlatform::updateOrCreate([
            'name' => 'YouTube',
            'link' => 'https://youtube.com',
            'icon' => 'fab fa-youtube',
        ]);

        SocialPlatform::updateOrCreate([
            'name' => 'WhatsApp',
            'link' => 'https://whatsapp.com',
            'icon' => 'fab fa-whatsapp',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Messenger',
            'link' => 'https://messenger.com',
            'icon' => 'fab fa-facebook-messenger',
        ]);
        SocialPlatform::updateOrCreate([
            'name' => 'Custom',
            'link' => 'https://messenger.com',
            'icon' => 'fab fa-facebook-messenger',
        ]);
    }
}
