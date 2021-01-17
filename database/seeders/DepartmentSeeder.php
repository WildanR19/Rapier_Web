<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name'          => 'Human Resource',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'General Affair',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Industrial Relation and General Affair',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Recruitment',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Organizational Development',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Training',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
