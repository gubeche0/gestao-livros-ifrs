<?php

use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aluno::class, 50)->create()->each(function ($aluno) {
            $aluno->save();
        });

    }
}
