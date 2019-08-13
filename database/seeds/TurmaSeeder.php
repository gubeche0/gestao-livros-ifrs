<?php

use Illuminate\Database\Seeder;
use App\Turma;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Info
        Turma::create([
            'nome' => '1º Info',
            'curso_id' => 1,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '2º Info',
            'curso_id' => 1,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '3º Info',
            'curso_id' => 1,
            'ano' => date('Y')
        ]);

        // Agro
        Turma::create([
            'nome' => '1º Agro A',
            'curso_id' => 2,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '2º Agro A',
            'curso_id' => 2,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '3º Agro A',
            'curso_id' => 2,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '1º Agro B',
            'curso_id' => 2,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '2º Agro B',
            'curso_id' => 2,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '3º Agro B',
            'curso_id' => 2,
            'ano' => date('Y')
        ]);

        // Eno
        Turma::create([
            'nome' => '1º Eno',
            'curso_id' => 3,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '2º Eno',
            'curso_id' => 3,
            'ano' => date('Y')
        ]);

        Turma::create([
            'nome' => '3º Eno',
            'curso_id' => 3,
            'ano' => date('Y')
        ]);

        // Meio
        Turma::create([
            'nome' => '1º Meio',
            'curso_id' => 4,
            'ano' => date('Y')
        ]);
        
    }
}
