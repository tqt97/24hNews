<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'name' =>  $name,
            'parent_id' => 0,
            'author_id' => 1,
            'status' => 1,
            'is_highlight' => 0,
            'slug' => Str::slug($name)
        ];
    }
}
