<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;

use Illuminate\Database\Seeder;




class UserEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'sonal sandeepa',
            'email' => 'sonal32@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        Employee::create([
            'user_id' => $user1->id,
            'designation' => 'Manager',
            'address' => 'Colombo',
            'epf_number' => 'EPF001',
            'annual_leave_count' => 14,
            'casual_leave_count' => 7,
        ]);

        $user = User::create([
            'name' => 'yash sandeepa',
            'email' => 'yash32@gmail.com',
            'password' => bcrypt('789654'),
        ]);

        Employee::create([
            'user_id' => $user->id,
            'designation' => 'engineer',
            'address' => 'Colombo',
            'epf_number' => 'EPF002',
            'annual_leave_count' => 14,
            'casual_leave_count' => 7,
        ]);
    }
}
