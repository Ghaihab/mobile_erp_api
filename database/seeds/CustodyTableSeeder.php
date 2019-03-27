<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustodyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Custody::insert([
            [
                'name' => 'Laptop',
                'rate' => '5',
            ],
            [
                'name' => 'Car',
                'rate' => '3',
            ],
            [
                'name' => 'Mobile',
                'rate' => '4'
            ],
            [
                'name' => 'House',
                'rate' => '1'
            ]
        ]);
    }
}
