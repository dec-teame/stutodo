<?php
// to add this file, run command below
// ./vendor/bin/sail php artisan make:seeder TodosSeeder 


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::factory()->count(5)->create();
    }
}
