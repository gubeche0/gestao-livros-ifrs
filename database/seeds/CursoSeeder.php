<?php

use Illuminate\Database\Seeder;
use App\Curso;
use App\User;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = User::first()->id;
        Curso::create([
            'nome' => 'Técnico em Informática para Internet',
            'abreviacao' => 'INFO',
            'user_id' => $id
        ]);

        Curso::create([
            'nome' => 'Técnico em Agropecuária',
            'abreviacao' => 'AGRO',
            'user_id' => $id
        ]);

        Curso::create([
            'nome' => 'Técnico em Viticultura e Enologia',
            'abreviacao' => 'ENO',
            'user_id' => $id
        ]);

        Curso::create([
            'nome' => 'Técnico em Meio Ambiente',
            'abreviacao' => 'MEIO',
            'user_id' => $id
        ]);
    }
}
