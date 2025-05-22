<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'name' => 'Admin',
            'username' => 'superadmin',
            'password' => bcrypt('superadmin'),
            'type' => 'SA',           

        ];
    }
}
