<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => $this->faker->uuid(),
            'date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'company_id' => $this->faker->uuid(),
            'billed_company_id' => $this->faker->uuid(),
            'status' => $this->faker->randomElement(['draft', 'approved', 'rejected']),
        ];
    }
}
