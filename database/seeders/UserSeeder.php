<?php

namespace Database\Seeders;

use App\Models\Employee_detail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $user = new User();
        $user->name         = 'Admin Name';
        $user->email        = 'admin@mail.com';
        $user->password     = Hash::make('123456');
        $user->role_id      = '1';
        $user->save();

        $employee = new Employee_detail();
        $employee->user_id      = $user->id;
        $employee->address      = 'address';
        $employee->join_date    = '2018-10-20';
        $employee->save();
        // DB::table('users')->insert([
        //     [
        //         'name'          => 'Admin',
        //         'email'         => 'admin'.'@mail.com',
        //         'password'      => Hash::make('password'),
        //         'status'        => 'Active',
        //         'role_id'       => '1',
        //         'created_at'    => now(),
        //         'updated_at'    => now(),
        //     ],
        //     [
        //         'name'          => 'budi',
        //         'email'         => 'budi'.'@mail.com',
        //         'password'      => Hash::make('password'),
        //         'status'        => 'Deactive',
        //         'role_id'       => '2',
        //         'created_at'    => date('Y-m-d H:i:s'),
        //         'updated_at'    => date('Y-m-d H:i:s'),
        //     ]
        // ]);

        // DB::table('employee_details')->insert([
        //     [
        //         'user_id'       => '1',
        //         'address'       => 'Everywhere Street 25',
        //         'gender'        => 'Male',
        //         'job_id'        => '1',
        //         'department_id' => '1',
        //         'join_date'     => '2018-10-20',
        //         'created_at'    => now(),
        //         'updated_at'    => now(),
        //     ],
        //     [
        //         'user_id'       => '2',
        //         'address'       => 'Jambu Street 21',
        //         'gender'        => 'Male',
        //         'job_id'        => '2',
        //         'department_id' => '2',
        //         'join_date'     => '2018-11-21',
        //         'created_at'    => now(),
        //         'updated_at'    => now(),
        //     ],
        // ]);
    }
}
