<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserModel::class;
    public function definition(): array
    {
        $username = 'admin';
        $password = bcrypt('12345');
        return [
            'username' => $username,
            'password' => $password,
        ];
    }
}
