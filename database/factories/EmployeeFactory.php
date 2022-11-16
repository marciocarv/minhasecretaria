<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{

    protected $model = Employee::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'date_birth'=>$this->faker->date(),
            'father'=>$this->faker->name($gender='male'),
            'mother'=>$this->faker->name($gender='female'),
            'naturalness'=>$this->faker->city(),
            'marital_status'=>$this->faker->word(),
            'sex'=>$this->faker->word(),
            'color'=>$this->faker->words(),
            'phone'=>$this->faker->cellphone(true, true),
            'certificate_type'=>$this->faker->word(),
            'certificate_term'=>$this->faker->word(),
            'certificate_book'=>$this->faker->word(),
            'certificate_sheet'=>$this->faker->word(),
            'address'=>$this->faker->streetAddress(),
            'cep'=>'7700100',
            'rg'=>$this->faker->rg(false),
            'rg_expedition'=>$this->faker->date(),
            'cpf'=>$this->faker->cpf(false),
            'bank_name'=>$this->faker->word(2, true),
            'bank_agency'=>'123456',
            'bank_number'=>'123456',
            'schooling'=>$this->faker->word(),
            'course_name'=>$this->faker->word(3, true),
            'course_status'=>$this->faker->word(),
            'name_college'=>$this->faker->word(3, true),
            'conclusion'=>$this->faker->date(),
            'id_censo'=>'123456789123',
            'admission'=>$this->faker->date(),
        ];
    }
}
