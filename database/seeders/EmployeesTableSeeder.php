<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insertOrIgnore([
            [
                'id' => 1,
                'code' => '124',
                'name' => 'Roberto Alvaro',
                'nickname' => 'Beto',
                'mother_name' => 'Maria Silva',
                'father_name' => 'José Alvaro',
                'document' => '12345678909',
                'birth_date' => '1990-05-15',
                'role' => 'Desenvolvedor',
            ],
            [
                'id' => 2,
                'code' => '175',
                'name' => 'Ana Paula Souza',
                'nickname' => 'Ana',
                'mother_name' => 'Clara Souza',
                'father_name' => 'Carlos Souza',
                'document' => '98765432100',
                'birth_date' => '1995-08-22',
                'role' => 'Marketing',
            ],
            [
                'id' => 3,
                'code' => '215',
                'name' => 'Lucas Mendes',
                'nickname' => 'Lu',
                'mother_name' => 'Fernanda Mendes',
                'father_name' => 'Ricardo Mendes',
                'document' => '45678912300',
                'birth_date' => '1985-12-10',
                'role' => 'RH',
            ],
            [
                'id' => 4,
                'code' => '235',
                'name' => 'Juliana Costa',
                'nickname' => 'Ju',
                'mother_name' => 'Patrícia Costa',
                'father_name' => 'Marcos Costa',
                'document' => '32165498700',
                'birth_date' => '1998-04-03',
                'role' => 'Desenvolvedor Web',
            ],
            [
                'id' => 5,
                'code' => '351',
                'name' => 'Pedro Henrique Lima',
                'nickname' => 'Pedro',
                'mother_name' => 'Sandra Lima',
                'father_name' => 'Antônio Lima',
                'document' => '65498732100',
                'birth_date' => '2000-11-25',
                'role' => 'QA',
            ],
        ]);
    }
}
