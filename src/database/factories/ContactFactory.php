<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;


class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique->safeEmail(),
            'tel' => $this->faker->numerify('0##########'),
            'address' => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress(),
            'category_id' => Category::inRandomOrder()->value('id'),
            'detail' => $this->faker->realText(50),
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now')

        ];
    }
}
