<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'David', 
            'username' => 'pasien1',
            // 'role_id' => '2',
            'password' => bcrypt('123123123'),
            'no_hp' => '088233081642',
            'alamat' => 'Sragen',
            'jenis_kelamin' => 'laki laki',
            'umur' => '21'

        ]);

        $role = Role::create(['name' => 'Perawat']);
   
        $role->syncPermissions([24, 25, 26, 27]);
     
        $user->assignRole([$role->id]);   
    }
}
