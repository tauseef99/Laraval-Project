<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userObj = new User();
        $userObj->name = 'User Rafi';
        $userObj->email = 'userRafi@gmail.com';
        $userObj->password = '123456789';
        $userObj->type = 0;
        $userObj->image = 'default_image.jpg'; // giving default value
        $userObj->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Rafi';
        $adminObj->email = 'adminRafi@gmail.com';
        $adminObj->password = '123456789';
        $adminObj->type = 1;
        $adminObj->image = 'default_image.jpg'; // giving default value
        $adminObj->save();

        $superAdminObj = new User();
        $superAdminObj->name = 'Super Admin Rafi';
        $superAdminObj->email = 'superAdminRafi@gmail.com';
        $superAdminObj->password = '123456789';
        $superAdminObj->type = 2;
        $superAdminObj->image = 'default_image.jpg'; // giving default value
        $superAdminObj->save();
    }
}
