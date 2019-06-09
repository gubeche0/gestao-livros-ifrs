<?php

use Illuminate\Database\Seeder;
use App\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::create([
            'nome' => 'Técnico em informática para internet',
            'abreviacao' => 'INFO'
        ]);

        Curso::create([
            'nome' => 'Agropecuária',
            'abreviacao' => 'AGRO'
        ]);

        Curso::create([
            'nome' => 'Viticultura e Enologia',
            'abreviacao' => 'ENO'
        ]);

        Curso::create([
            'nome' => 'Meio Ambiente',
            'abreviacao' => 'MEIO'
        ]);
    }
}
