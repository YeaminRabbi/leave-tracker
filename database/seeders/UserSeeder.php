<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $admin = Role::create(['name' => 'admin']);
        $employee = Role::create(['name' => 'employee']);

        //creating a admin user
        $AdminUser = new User;
        $AdminUser->name = 'Admin';
        $AdminUser->email = 'admin@gmail.com';
        $AdminUser->password =  Hash::make('123');
        $AdminUser->account_approval =  true;
        $AdminUser->save();

        $AdminUser->assignRole($admin);

        //creating a employee user
        $EmployeeUser = new User;
        $EmployeeUser->name = 'Employee';
        $EmployeeUser->email = 'employee@gmail.com';
        $EmployeeUser->password =  Hash::make('123');
        $EmployeeUser->account_approval =  true;
        $EmployeeUser->save();

        $EmployeeUser->assignRole($employee);

    }
}