<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        $id = User::first()->id;
        Categoria::create([
            'nome' => 'Matemática',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Português',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Física',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Química',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Geografia',
            'user_id' => $id
        ]);

        Categoria::create([
            'nome' => 'Espanhol',
            'user_id' => $id
        ]);
    }
}
