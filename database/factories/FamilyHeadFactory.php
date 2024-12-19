<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyHead>
 */
class FamilyHeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
            return [
                'name' => $this->faker->firstName(), // Ensure 'name' is populated
                'surname' => $this->faker->lastName(),
                'birth_date' => $this->faker->date(),
                'mobile_no' => $this->faker->numberBetween(6000000000, 9999999999),
                'address' => $this->faker->address(),
                'state' => $this->faker->randomElement(['Maharashtra', 'Gujarat', 'Delhi', 'Madhya Pradesh']),
                'city' => $this->faker->randomElement(['Aurangabad', 'mumbai', 'Pune', 'Nanded']),
                'pincode' => $this->faker->postcode(),
                'marital_status' => $this->faker->randomElement(['married', 'unmarried']),
                'wedding_date' => $this->faker->optional()->date(),
                'hobbies' => json_encode($this->faker->randomElements(['Reading', 'Traveling', 'Gardening', 'Cooking'], 2)),
                'photo' => $this->faker->imageUrl(640, 480, 'people', true, 'Faker'),
            ];
        
    }
}
