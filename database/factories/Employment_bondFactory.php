<?php

namespace Database\Factories;

use App\Models\Employment_bond;
use Illuminate\Database\Eloquent\Factories\Factory;

class Employment_bondFactory extends Factory
{

    protected $model = Employment_bond::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'registration'=>$this->faker->randomNumber(6, true),
            'activity_start'=>$this->faker->date(),
            'activity_end'=>$this->faker->date(),
            'post'=>$this->faker->word(),
            'role'=>$this->faker->word(),
            'workload'=>'40',
            'status'=>'ATIVO',
            'bond'=>$this->faker->word(),
            'lotation'=>$this->faker->date()
        ];
    }
}
