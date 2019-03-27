<?php

use Illuminate\Database\Seeder;

class VacationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Vacation::insert([
            [
                'name' => 'Annual',
                'type' => 'Paid',
                'days' => 30
            ],
            [
                'name' => 'Sickness',
                'type' => 'Paid',
                'days' => 20,
            ],
            [
                'name' => 'Long Leave',
                'type' => 'UnPaid',
                'days' => 200
            ],
        ]);
    }
}
