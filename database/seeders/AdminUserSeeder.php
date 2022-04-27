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
        User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'gender' => 'male',
            'profile_image' => 'https://via.placeholder.com/200x200.png/000000?text=admin',
            'password' => bcrypt('123456')
        ]);

        $makeAdmins = User::latest()->first();
        $makeAdmins->assignRole('admin');
    }
}
