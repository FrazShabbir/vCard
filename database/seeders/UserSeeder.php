<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     if(! User::find(1)){
            $user = new User();
            $user->first_name = 'Admin';
            $user->last_name = 'User';
            $user->username = 'admin';
            $user->status = 1;
            $user->password = bcrypt('admin');
            $user->email = 'admin@wisevision.dev';
            $user->email_verified_at = now();
            // $user->ar_user = true;
            $user->assignRole('Super Admin');
            $user->save();
         }

    }

}
