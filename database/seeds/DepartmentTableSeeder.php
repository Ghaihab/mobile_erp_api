<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Department::insert([
            [
                'name' => 'IT'
            ],
            [
                'name' => 'HR'
            ],
            [
                'name' => 'Finance'
            ],
            [
                'name' => 'Business'
            ]
        ]);
    }
}
