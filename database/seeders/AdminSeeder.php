<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email', 'superadmin@gmail.com')->first();

        if(is_null($admin)){
            $admin = new Admin();
            $admin->name = "Super Admin";
            $admin->email = "superadmin@gmail.com";
            $admin->username = "superadmin";
            $admin->password = Hash::make('1234');
            $admin->save();
        }
    }
}
