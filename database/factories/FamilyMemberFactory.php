<?php

namespace Database\Factories;

use App\Models\FamilyHead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyMember>
 */
class FamilyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_head_id' => FamilyHead::inRandomOrder()->first()->id, // Assuming a relationship with FamilyHead
            'name' => $this->faker->name, // Generate a random name
            'm_birth_date' => $this->faker->date(), // Generate a random birth date
            'marital_status' =>  $maritalStatus = $this->faker->randomElement(['married', 'unmarried']),
            'wedding_date' => $maritalStatus == 'married' ? $this->faker->date() : null,
            'education' => $this->faker->randomElement(['high school', 'bachelor', 'master', 'PhD']), // Random education level
            'photo' => null, // Generate a random image URL for photo
    
        ];
    }
}
