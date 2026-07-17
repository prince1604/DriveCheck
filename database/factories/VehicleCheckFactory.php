<?php

namespace Database\Factories;

use App\Models\VehicleCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VehicleCheck>
 */
class VehicleCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::where('user_type_id', 2)->inRandomOrder()->first()->id ?? 2,
            'checking_point_id' => \App\Models\CheckingPoint::inRandomOrder()->first()->id ?? 1,
            'person_name' => $this->faker->name(),
            'shift_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'shift_type' => $this->faker->randomElement(['Day', 'Night']),
            'vehicle_no' => strtoupper($this->faker->bothify('GJ-??-####')),
            'employee_id_no' => $this->faker->optional(0.7)->numerify('EMP-####'),
            'checking_time' => $this->faker->time('H:i'),
            'remark' => $this->faker->optional(0.5)->sentence(),
            'vehicle_photo' => null, // seeded records won't have photos unless we create mock files, null is fine
        ];
    }
}
