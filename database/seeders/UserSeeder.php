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
        $user->name         = 'Admin';
        $user->email        = 'admin@mail.com';
        $user->password     = Hash::make('123456');
        $user->role_id      = '1';
        $user->save();

        $employee = new Employee_detail();
        $employee->user_id          = $user->id;
        $employee->address          = 'address';
        $employee->gender           = 'male';
        $employee->join_date        = '2018-10-20';
        $employee->save();
    }
}
