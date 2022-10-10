<?php
// to add this file, run command below
// sail artisan make:factory TodosFactory --model==Todos

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Todos>
 */
class TodosFactory extends Factory
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
            'task' => $this->faker-> ***,
            'deadline' => $deadline_date->format('Y-m-d'),  // dateTimeをフォーマット変換
            'importance' => $this->faker->numberBetween(1, 3),
            'description' => $this->faker->realText($this->faker->numberBetween(10, 20)),
        ];
    }
}

