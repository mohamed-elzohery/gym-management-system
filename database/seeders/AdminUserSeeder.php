<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::create(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('123456'), 'gender' => 'male']);

        $makeAdmins = User::latest()->take(1)->get();
        $makeAdmins->assignRole('admin');
    }
}
