<?php
// to add this file, run command below
// ./vendor/bin/sail php artisan make:seeder TodosSeeder 

// to generate seed data, run command below
// todoのシードデータを追加するには以下のコマンドを実行してください。
// ./vendor/bin/sail php artisan db:seed --class=TodosSeeder


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

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
