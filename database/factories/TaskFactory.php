<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->sentence,
            'description'    => $this->faker->paragraph,
            'status_id'      => TaskStatus::factory()->newest(),
            'created_by_id'  => User::factory(),
            'assigned_to_id' => User::factory(),
        ];
    }

    public function createdBy(User $user): TaskFactory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'created_by_id' => $user->id,
            ];
        });
    }
}
