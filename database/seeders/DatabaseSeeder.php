<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Employment_bond;
use App\Models\User;
use Database\Factories\EmployeeFactory;
use Database\Factories\Employment_bondFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(2)->create();
        //User::factory(2)->create();
    }
}
