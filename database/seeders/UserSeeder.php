<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Jair Augusto Villazón Sosa',
            'email' => 'jairvsosa@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole($role);

        User::factory(100)->create();

    }
}
