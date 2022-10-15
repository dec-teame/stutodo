<?php
// to add this file, run command below
// sail artisan make:factory TodoFactory --model=Todo

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $deadline_date = $this->faker->dateTimeBetween('-30 days', 'now');
        $user_id = 1;

        return [
            // 'user_id' => $this->faker->numberBetween(1, 5),      // user_idが1から5までの人のデータを生成
            'user_id' => $this->faker->numberBetween($user_id, $user_id),
            // TODO ここはあらかじめタスクを登録しておきたい。
            // 'task' => $this->faker->realText($this->faker->numberBetween(5, 10)),
            
            'task' => $this->faker->country(),
            'deadline' => $deadline_date->format('Y-m-d'),  // dateTimeをフォーマット変換 2022-10-11
            'importance' => $this->faker->numberBetween(1, 3),
            'description' => $this->faker->realText($this->faker->numberBetween(10, 20)),
            'finished' => $this ->faker->boolean(50),   //引数の中身はTrueが出る確率
        ];
    }
}

