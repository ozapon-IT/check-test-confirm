<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Contact::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'email' => $this->faker->safeEmail,
            'tell' => $this->faker->numerify('###-####-####'),
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'category_id' => Category::inRandomOrder()->first()->id,
            'detail' => $this->faker->realText(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
