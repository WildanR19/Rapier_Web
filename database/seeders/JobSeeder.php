<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            [
                'name'          => 'HR & GA Division Head',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'HR Development Dept Head',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'HR Operations & IRGA Dept Head',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Recruitment Supervisor',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Training Supervisor',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'OD Supervisor',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'HR Operations Supervisor',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'IR & GA Supervisor',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Recruitment Staff',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Training Staff',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'OD Staff',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'HR Operation Staff',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'GA Staff',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
