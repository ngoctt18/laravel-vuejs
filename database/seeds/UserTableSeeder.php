<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'employee')->first();
        $role_manager = Role::where('name', 'admin')->first();
        $role_saler = Role::where('name', 'saler')->first();

        $employee = new User();
        $employee->name = 'Employee Name';
        $employee->email = 'employee@example.com';
        $employee->password = bcrypt('123456');
        $employee->save();
        $employee->roles()->attach($role_employee, ['created_at' => now(), 'updated_at' => now()]);

        $saler = new User();
        $saler->name = 'Saler Name';
        $saler->email = 'saler@example.com';
        $saler->password = bcrypt('123456');
        $saler->save();
        $saler->roles()->attach($role_saler, ['created_at' => now(), 'updated_at' => now()]);

        $manager = new User();
        $manager->name = 'Admin Name';
        $manager->email = 'admin@example.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($role_manager, ['created_at' => now(), 'updated_at' => now()]);
    }
}
