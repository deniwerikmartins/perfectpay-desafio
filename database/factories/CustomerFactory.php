<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $cpf = $faker->cpf(false);

        return [
            'user_id' => self::factoryForModel(User::class),
            'customer_id' => null,
            'name' => $this->faker->name(),
            'cpfCnpj' => $this->faker->cpf(false),
            'email' => $this->faker->email(),
            'postalCode' => '01310-000',
            'addressNumber' => $this->faker->buildingNumber(),
            'phone' => $this->faker->phoneNumber()

        ];
    }
}
