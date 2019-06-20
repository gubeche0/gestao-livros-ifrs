<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = User::first()->id;
        Categoria::create([
            'nome' => 'Matematica',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Portugues',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Fisica',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Quimica',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Matematica',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Matematica',
            'user_id' => $id
        ]);
    }
}
