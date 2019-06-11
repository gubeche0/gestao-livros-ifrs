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
            'nome' => 'Técnico em informática para internet',
            'abreviacao' => 'INFO',
            'user_id' => $id
        ]);

        Curso::create([
            'nome' => 'Agropecuária',
            'abreviacao' => 'AGRO',
            'user_id' => $id
        ]);

        Curso::create([
            'nome' => 'Viticultura e Enologia',
            'abreviacao' => 'ENO',
            'user_id' => $id
        ]);

        Curso::create([
            'nome' => 'Meio Ambiente',
            'abreviacao' => 'MEIO',
            'user_id' => $id
        ]);
    }
}
