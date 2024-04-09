<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'username' => 'admin',
            // 'role_id' => '1',
            'password' => bcrypt('admin123'),
            'no_hp' => '085275204102',
            'alamat' => 'Sragen',
            'jenis_kelamin' => 'laki laki',
            'umur' => '21'
        ]);
    
        $role = Role::create(['name' => 'Rekam Medis']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}