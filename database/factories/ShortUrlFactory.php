<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortUrl>
 */
class ShortUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'original_url'=>$this->faker->domainName(),
            'short_code'=>now().str()->random(6),
        ];
    }

    // public function setCompany($company_id):static{
    //     return $this->state(fn()=>[
    //         'company_id'=>$company_id
    //     ]);
    // }

    // public function forCompany($company): static
    // {
    //     return $this->for($company);
    // }



}
